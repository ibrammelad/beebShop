<?php

namespace App\Http\Controllers\Api\Driver;

use App\Http\Controllers\Api\ResponseController;
use App\Http\Controllers\Controller;
use App\Models\Work;
use App\Rules\MatchOldPassword;
use App\Rules\MatchOldPasswordDriver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use function Matrix\trace;

class UpdateDriverInformationController extends ResponseController
{
  public function updateDriver(Request $request)
  {
    try {

      $driver = auth()->guard('work')->user();
      $rules = [
        'email' => [Rule::unique('works', 'email')->ignore($driver->id)],
        'name' => [Rule::unique('works', 'name')->ignore($driver->id)],
        'phone' => [Rule::unique('works', 'phone')->ignore($driver->id)],
        'address' => 'string',
        'age' => 'numeric',
        'city_id' => 'exists:cities,id'
      ];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        return $this->sendError("404", [$validator->errors()]);
      }
      $data = $request->all();
      if ($request->hasFile('image')) {
        $image = $driver->image;
        $images = public_path('images/drivers/' . $image);
        if ($image == null) {
          unlink($images);// delete photo from directory
        }
        $image1 = $request->image;
        $new_name = Str::random(12).'.'.$image1->getClientOriginalExtension();
        $image1->move(public_path("images/drivers"), $new_name);
        $data['image'] = $new_name;
      }

      if ($request->hasFile('idImage')) {
        $img = $driver->idImage;
        $photo = public_path('images/drivers/ids/' . $img);
        if ($photo == null) {
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
        if ($license == null){
            unlink($license_image);// delete photo from directory
          }
          $license1 = $request->$license;
        $license_name2 = Str::random(12).'.'.$license1->getClientOriginalExtension();
        $license1->move(public_path("images/drivers/ids"), $license_name2);
        $data['license'] = $license_name2;
      }
      if ($request->hasFile('licenseCar')) {
        $licenseCar = $driver->licenseCar;
        $licenseCar1 = public_path('images/drivers/licenseCar/' . $licenseCar);
        if ($licenseCar == null) {
            unlink($licenseCar1);// delete photo from directory
          }
          $licenseCar8 = $request->licenseCar;
         $licenseCar_name2 = Str::random(12).'.'.$licenseCar8->getClientOriginalExtension();
         $licenseCar8->move(public_path("images/drivers/licenseCar"), $licenseCar_name2);
          $data['licenseCar'] = $licenseCar_name2;
        }
        auth()->guard('work')->user()->update($data);
        return $this->sendResponse($driver);
      } catch (\Exception $exception) {
      $message = $exception->getMessage();
      return $this->sendError('404', [$message]);
    }

  }


  public function updateImage(Request $request)
  {
    try {

      $driver = auth()->guard('work')->user();
      $rules = ['image' => 'image|mimes:jpeg,png,jpg',];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        return $this->sendError("404", [$validator->errors()]);
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
      $driver->update($data);

      return $this->sendResponse($driver);
    } catch (\Exception $exception) {
      $message = $exception->getMessage();
      return $this->sendError('404', [$message]);
    }

  }

  public function deleteImage()
  {
    $driver = auth()->guard('work')->user();
    $image = $driver->image;
    $imagee = public_path('images/drivers/' . $image);
    if ($image != null) {
      unlink($imagee);// delete photo from directory
    }
    $data['image'] = null;
    $driver->update($data);
    return $this->sendResponse($driver);

  }

  public function updatePassword(Request $request)
  {
    $request->validate([

      'current_password' => ['required', new MatchOldPasswordDriver()],

      'new_password' => ['required'],

      'new_confirm_password' => ['same:new_password'],

    ]);

    Work::find(auth()->guard('work')->user()->id)->update(['password' => Hash::make($request->new_password)]);
    return response()->json(['data' => "successfully ", 'success' => true], 200);

  }


}
