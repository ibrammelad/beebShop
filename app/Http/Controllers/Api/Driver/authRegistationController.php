<?php

namespace App\Http\Controllers\Api\Driver;

use App\Http\Controllers\Api\ResponseController;
use App\Models\Work;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Validator;
class authRegistationController extends ResponseController
{
  public function registerDriver(Request $request)
  {
    try {

      $rules = [
        'email' => 'required|unique:users|max:55',
        'password' => 'required|min:6',
        'name' => 'required|unique:users|max:55',
        'image' => 'mimes:jpeg,png,jpg',
        'idImage' => 'required|mimes:jpeg,png,jpg',
        'licenseCar' => 'required|mimes:jpeg,png,jpg',
        'phone' => 'required|unique:users',
        'address' => 'required|string',
        'age' => 'required|numeric',
        'city_id' => 'required|exists:cities,id'
      ];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()){
        return $this->sendError("404" , [$validator->errors()]);
      }
      $driver = $request->only(['name', 'email', 'phone', 'address', 'age']);
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
      $driver['is_driver'] = 1;
      $driverAccount = Work::create($driver);
      $success['token'] = $driverAccount->createToken($driverAccount->name)->plainTextToken;
      $success['user'] =  Work::where('id' , $driverAccount->id)->first();
      return $this->sendResponse($success);
    } catch (\Exception $exception) {
      $message  = $exception->getMessage();
      return $this->sendError('404',[$message]);
    }
  }


  public function registerBothHD(Request $request)
  {
    try {

      $rules = [
        'email' => 'required|unique:users|max:55',
        'password' => 'required|min:6',
        'name' => 'required|unique:users|max:55',
        'image' => 'required|mimes:jpeg,png,jpg',
        'idImage' => 'required|mimes:jpeg,png,jpg',
        'licenseCar' => 'required|mimes:jpeg,png,jpg',
        'phone' => 'required|unique:users',
        'address' => 'required|string',
        'age' => 'required|numeric',
        'city_id' => 'required|exists:cities,id'
      ];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()){
        return $this->sendError("404" , [$validator->errors()]);
      }
      $driver = $request->only(['name', 'email', 'phone', 'address', 'age' , 'city_id']);
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
      $driver['is_driver'] = 1;
      $driver['is_helper'] = 1;
      $driverAccount = Work::create($driver);
      $success['token'] = $driverAccount->createToken($driverAccount->name)->plainTextToken;
      $success['user'] =  Work::where('id' , $driverAccount->id)->first();
      return $this->sendResponse($success);
    } catch (\Exception $exception) {
      $message  = $exception->getMessage();
      return $this->sendError('404',[$message]);
    }
  }

  public function login(Request $request)
  {
    $user = Work::where('email', $request->email)->orWhere('phone', $request->email)->orWhere('name', $request->email)->first();
    if (!$user || !Hash::check($request->password, $user->password)) {
      return $this->sendError('Unauthorised.',
        'email The provided credentials are incorrect.'
      );
    } else {
      $success['token'] = $user->createToken($user->name)->plainTextToken;
    }
     $success['user'] = $user;
    return $this->sendResponse($success);
  }
}
