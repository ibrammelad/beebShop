<?php

namespace App\Http\Controllers\Api\Helper;

use App\Http\Controllers\Api\ResponseController;
use App\Http\Controllers\Controller;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class authRegistrationController extends ResponseController
{
  public function registerHelper(Request $request)
  {
    try {

      $rules = [
        'email' => 'required|unique:users|max:55',
        'password' => 'required|min:6',
        'name' => 'required|unique:users|max:55',
        'phone' => 'required|unique:users',
        'image' => 'mimes:jpeg,png,jpg',
        'idImage' => 'required||mimes:jpeg,png,jpg',
        'address' => 'required|string',
        'age' => 'required|numeric',
        'order_place' => 'required|exists:order_places,id'
      ];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()){
        return $this->sendError("404" , [$validator->errors()]);
      }
      $helper = $request->only(['name', 'email', 'phone', 'address', 'age', 'order_place']);
      ////////////////// user ///////////////////
      if ($request->hasFile('image')) {
        $image = $request->image;
        $new_name = Str::random(12).'.'.$image->getClientOriginalExtension();
        $image->move(public_path("images/drivers"), $new_name);
        $helper['image'] = $new_name;
      }
      $helper['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
      if ($request->hasFile('idImage')) {
        $img = $request->idImage;
        $new_name = Str::random(12).'.'.$img->getClientOriginalExtension();
        $img->move(public_path("images/drivers/ids"), $new_name);
        $helper['idImage'] = $new_name;
      }
      if ($request->hasFile('license')) {
        $license = $request->license;
        $license_name = Str::random(12).'.'.$license->getClientOriginalExtension();

        $license->move(public_path("images/drivers/license"), $license_name);
        $helper['license'] = $license_name;
      }
      $helper['is_helper'] = 1;
      $helperAccount = Work::create($helper);
      $success['token'] = $helperAccount->createToken($helperAccount->name)->plainTextToken;
      $success['user'] = Work::where('id', $helperAccount->id)->first();
      return $this->sendResponse($success);
    } catch (\Exception $exception) {
      $message  = $exception->getMessage();
      return $this->sendError('404',[$message]);
    }
  }
}
