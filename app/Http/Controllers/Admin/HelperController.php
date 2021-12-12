<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Driver;
use App\Models\OrderPlace;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class HelperController extends Controller

{
  public function __construct()
  {
    $this->middleware(['role_or_permission:super admin|view_user|modify_user'])->only('showHelpers');
    $this->middleware(['role_or_permission:super admin|modify_user'])->except('showHelpers');
  }
  public function showHelpers()
  {
    $users = Work::where('is_helper', 1)->paginate(20);
    return view('admin.pages.driver-helper.indexHelpers', compact('users'));
  }

  public function create_helpers()
  {
    $cities = OrderPlace::active()->get();
    return view('admin.pages.driver-helper.createHelper',compact('cities'));

  }

  public function store_helpers(Request $request)
  {
    try {

      $rules = [
        'email' => 'required|unique:users|max:55',
        'password' => 'required|min:6',
        'name' => 'required|unique:users|max:55',
        'image' => 'required|image|mimes:jpeg,png,jpg',
        'idImage' => 'required|image|mimes:jpeg,png,jpg',
        'license' => 'mimes:jpeg,png,jpg',
        'licenseCar' => 'image|mimes:jpeg,png,jpg',
        'phone' => 'required|unique:users',
        'address' => 'required|string',
        'age' => 'required|numeric',
        'order_place' => 'required|exists:order_places,id',
      ];
      $this->validate($request, $rules);
      $driver = $request->only(['name', 'email', 'phone', 'address', 'age' ,'order_place']);
      ////////////////// user ///////////////////
      if ($request->hasFile('image')) {
        $image = $request->image;
        $new_name = Str::random(12).'.'.$image->getClientOriginalExtension();
        $image->move(public_path("images/drivers"), $new_name);
        $driver['image'] = $new_name;
      }
      $driver['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
      if ($request->hasFile('idImage')) {
        $img = $request->idImage;
        $new_name = Str::random(12).'.'.$img->getClientOriginalExtension();

        $img->move(public_path("images/drivers/ids"), $new_name);
        $driver['idImage'] = $new_name;
      }
      if ($request->hasFile('license')) {
        $license = $request->license;
        $license_name = rand() . $license->getClientOriginalName();
        $license->move(public_path("images/drivers/license"), $license_name);
        $driver['license'] = $license_name;
      }
      if ($request->hasFile('licenseCar')) {
        $licenseCar = $request->licenseCar;
        $licenseCar_name = Str::random(12).'.'.$licenseCar->getClientOriginalExtension();
        $licenseCar->move(public_path("images/drivers/licenseCar"), $licenseCar_name);
        $driver['licenseCar'] = $licenseCar_name;
      }
      $request->has('is_driver') ? $driver['is_driver'] = 1 : $driver['is_driver'] = 0;

      $driver['status'] = $request->status;
      $driver['is_helper'] = 1;
      Work::create($driver);
      /////////////////////// activity log ////////////////
      ActivityLog::create([
        'log_name' => 'helper',
        'description' => "add driver with name " . $driver['name'],
        'causer' => auth()->user()->id,
        'subject' => 'Add'
      ]);
      return redirect()->route('index_helpers')->with(['success' => "Helper add successfully"]);
    } catch (\Exception $exception) {
      DB::rollBack();
      return redirect()->route('index_helpers')->with(['errors' => "some error occur"]);

    }
  }

  public function edit_helpers($id)
  {
    $user = Work::findOrFail($id);
    return view('admin.pages.driver-helper.editHelper', compact('user'));

  }

  public function update_helpers(Request $request, $id)
  {
    try {
      $driver = Work::findOrFail($id);

      $rules = [
        'email' => [Rule::unique('works', 'email')->ignore($driver->id)],
        'name' => [Rule::unique('works', 'name')->ignore($driver->id)],
        'phone' => [Rule::unique('works', 'phone')->ignore($driver->id)],
        'is_helper' => 'in:0,1',
        'address' => 'required|string',
        'age' => "required|numeric",
      ];
      $this->validate($request, $rules);
      DB::beginTransaction();
      /////////////////// user ////////////////////
      $data = $request->only(['name', 'email', 'phone', 'age','password','address', 'is_driver']);
      if ($data['password'] == '') {
        $data['password'] = $driver->password;
      } else {
        $data['password'] = Hash::make($data['password']);
      }
      if ($request->hasFile('image')) {
        $image = $driver->image;
        $imagee = public_path('images/drivers/' . $image);
        if ($image != null) {
          unlink($imagee);// delete photo from directory
        }
        $image1 = $request->image;
        $new_name = Str::random(12).'.'.$image1->getClientOriginalExtension();
        $image1->move(public_path("images/drivers"), $new_name);
        $data['image'] = $new_name;
      }

      if ($request->hasFile('idImage')) {
        $img = $driver->idImage;
        $photo = public_path('images/drivers/ids/' . $img);
        if ($img != null) {
          unlink($photo);// delete photo from directory
        }
        $img1 = $request->idImage;
        $new_name2 = Str::random(12).'.'.$img1->getClientOriginalExtension();
        $img1->move(public_path("images/drivers/ids"), $new_name2);
        $data['idImage'] = $new_name2;
      }
      if ($request->hasFile('license')) {
        $license = $driver->license;
        $license_image = public_path('images/drivers/license/' . $license);
        if ($license != null) {
          unlink($license_image);// delete photo from directory
        }
        $license1 = $request->$license;
        $license_name2 = Str::random(12).'.'.$license1->getClientOriginalExtension();
        $license1->move(public_path("images/drivers/license"), $license_name2);
        $data['license'] = $license_name2;
      }
      if ($request->hasFile('licenseCar')) {
        $licenseCar = $driver->licenseCar;
        $licenseCar1 = public_path('images/drivers/licenseCar/' . $licenseCar);
        if ($licenseCar != null) {
          unlink($licenseCar1);// delete photo from directory
        }
        $licenseCar8 = $request->licenseCar;
        $licenseCar_name2 = Str::random(12).'.'.$licenseCar8->getClientOriginalExtension();
        $licenseCar8->move(public_path("images/drivers/licenseCar"), $licenseCar_name2);
        $data['licenseCar'] = $licenseCar_name2;
      }
      $data['status'] = $request->status;
      $data['is_helper'] = 1;
      $request->has('is_driver') ? $data['is_driver'] = 1 : $data['is_driver'] = 0;
      $driver->update($data);
      ActivityLog::create([
        'log_name' => 'Helper',
        'description' => "update Helper with name " . $driver->name,
        'causer' => auth()->user()->id,
        'subject' => 'Edit'
      ]);
      DB::commit();
      return redirect()->route('index_helpers')->with(['success' => "update successfully"]);
    } catch (\Exception $exception) {
      DB::rollBack();
      $this->validate($request, $rules);

      return redirect()->route('index_helpers')->with(['error' => "some error occur "]);

    }
  }

  public function delete_helpers($id)
  {
    $helper = Work::findOrFail($id);
    DB::beginTransaction();
    if ($helper->image != null) {
      $image = $helper->image;
      $imagee = public_path('images/drivers/' . $image);
      // get the path of basic app
      if (!empty($image)) {
        unlink($imagee);
      }// delete photo from directory
    }
    if ($helper->idImage != null) {
      $img = $helper->idImage;
      $imag = public_path('images/drivers/ids/' . $img);  // get the path of basic app
      if (!empty($img)) {
        unlink($imag);
      }// delete photo from directory
    }
    $helper->delete();
    ActivityLog::create([
      'log_name' => 'Helper',
      'description' => "delete Helper with name " . $helper->name,
      'causer' => auth()->user()->id,
      'subject' => 'Delete'
    ]);
    DB::commit();
    return redirect()->route('index_helpers')->with(['success' => "Deleted successfully"]);

  }
}
