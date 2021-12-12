<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\City;
use App\Models\Driver;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DriverController extends Controller

{
  public function __construct()
  {

    $this->middleware(['role_or_permission:super admin|view_user|modify_user'])->only('showDrivers');
    $this->middleware(['role_or_permission:super admin|modify_user'])->except('showDrivers');

  }

  public function showDrivers()
  {
    $users = Work::where('is_driver', 1)->paginate();
    $drivers = Work::where('is_driver', 1)->get();
    $d =[];
    foreach ($drivers as $index => $user) {
      $reviews = $user->review;
      $star = 0;
      foreach ($reviews as $review) {
         $star = $star + $review->stars;

      }
      if (!$reviews->isEmpty()) {
        $d[$index]= $star / count($reviews);

      }
    }
    return view('admin.pages.driver-helper.indexDrivers', compact('users', 'd'));
  }

  public function create_drivers()
  {
    $cities = City::all();
    return view('admin.pages.driver-helper.createDriver' , compact('cities'));

  }

  public function store_drivers(Request $request)
  {
    try {

      $rules = [
        'email' => 'required|unique:users|max:55',
        'password' => 'required|min:6',
        'name' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg',
        'idImage' => 'required|image|mimes:jpeg,png,jpg',
        'license' => 'image|mimes:jpeg,png,jpg',
        'licenseCar' => 'required|image|mimes:jpeg,png,jpg',
        'phone' => 'required|unique:users',
        'address' => 'required|string',
        'age' => 'required|numeric',
        'city_id'=>"required|exists:cities,id",

      ];
      $this->validate($request, $rules);
      $driver = $request->only(['name', 'email', 'phone', 'address', 'age', 'city_id']);
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
        $new_name2 = Str::random(12).'.'.$img->getClientOriginalExtension();
        $img->move(public_path("images/drivers/ids"), $new_name2);
        $driver['idImage'] = $new_name2;
      }
      if ($request->hasFile('license')) {
        $license = $request->license;
        $license_name = Str::random(12).'.'.$license->getClientOriginalExtension();
        $license->move(public_path("images/drivers/license"), $license_name);
        $driver['license'] = $license_name;
      }
      if ($request->hasFile('licenseCar')) {
        $licenseCar = $request->licenseCar;
        $licenseCar_name = Str::random(12).'.'.$licenseCar->getClientOriginalExtension();
        $licenseCar->move(public_path("images/drivers/licenseCar"), $licenseCar_name);
        $driver['licenseCar'] = $licenseCar_name;
      }
      $request->has('is_helper') ? $driver['is_helper'] = 1 : $driver['is_helper'] = 0;

      $driver['status'] = $request->status;
      $driver['is_driver'] = 1;
      Work::create($driver);
      /////////////////////// activity log ////////////////
      ActivityLog::create([
        'log_name' => 'driver',
        'description' => "add driver with name " . $driver['name'],
        'causer' => auth()->user()->id,
        'subject' => 'Add'
      ]);
      return redirect()->route('index_drivers')->with(['success' => "Driver add successfully"]);
    } catch (\Exception $exception) {
      DB::rollBack();
      $this->validate($request, $rules);
      return redirect()->route('create_drivers')->with(['errors' => "some error occur"]);

    }
  }

  public function edit_drivers($id)
  {
    $user = Work::findOrFail($id);
    return view('admin.pages.driver-helper.editDriver', compact('user'));

  }

  public function update_drivers(Request $request, $id)
  {
    try {
      $driver = Work::findOrFail($id);

      $rules = [
        'email' => [Rule::unique('works', 'email')->ignore($driver->id)],
        'name' => [Rule::unique('works', 'name')->ignore($driver->id)],
        'phone' => [Rule::unique('works', 'phone')->ignore($driver->id)],
        'image' => 'image|mimes:jpeg,png,jpg',
        'idImage' => 'image|mimes:jpeg,png,jpg',
        'license' => 'image|mimes:jpeg,png,jpg',
        'licenseCar' => 'image|mimes:jpeg,png,jpg',
        'is_helper' => 'in:0,1',
        'address' => 'required|string',
        'age' => "required|numeric",
      ];
      $this->validate($request, $rules);
      DB::beginTransaction();
      /////////////////// user ////////////////////
      $data = $request->only(['name', 'email', 'phone', 'address', 'age', 'password', 'address', 'is_helper']);
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
        $license1 = $request->license;
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
      $data['is_driver'] = 1;
      $request->has('is_helper') ? $data['is_helper'] = 1 : $data['is_helper'] = 0;
      $driver->update($data);
      ActivityLog::create([
        'log_name' => 'Driver',
        'description' => "update Driver with name " . $driver->name,
        'causer' => auth()->user()->id,
        'subject' => 'Edit'
      ]);
      DB::commit();
      return redirect()->route('index_drivers')->with(['success' => "update successfully"]);
    } catch (\Exception $exception) {
      DB::rollBack();
      return redirect()->route('index_drivers')->with(['error' => "some error occur "]);

    }
  }

  public function delete_drivers($id)
  {
    try {

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
        'description' => "delete Driver with name " . $helper->name,
        'causer' => auth()->user()->id,
        'subject' => 'Delete'
      ]);
      DB::commit();
      return redirect()->route('index_drivers')->with(['success' => "Deleted successfully"]);
    } catch (\Exception $exception) {
      DB::rollBack();
      return redirect()->route('index_drivers')->with(['error' => "some error occur "]);

    }
  }

}
