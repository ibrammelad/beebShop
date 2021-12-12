<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Api\ResponseController;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UpdateInformationController extends ResponseController
{

  public function updateCustomer(Request $request)
  {
    $reules=[
      'email' => 'required|max:55',
      'name'  =>  'required',
      'phone' => 'required' ,
      'address' => 'required',

    ];
    $this->validate($request, $reules);
    $data = $request->all();
     auth()->user()->update($data);
     $user =auth()->user();
    return $this->sendResponse($user);

  }

  public function updateImage(Request $request)
  {
      $this->validate($request,['image' => 'image|mimes:jpeg,png,jpg' ,]);
      $user =auth()->user();
       if($request->hasFile('image')) {
          $image = $user->image;
          $imagee = public_path('images/users/' . $image);
          if ($image != null) {
            unlink($imagee);// delete photo from directory
          }
          $image1 = $request->image;
          $new_name = Str::random(12).'.'.$image1->getClientOriginalExtension();
          $image1->move(public_path("images/users"), $new_name);
        $data['image'] = $new_name;
      }
      $user->update($data);

    return $this->sendResponse($user);

  }
  public function deleteImage(Request $request)
  {
      $user =auth()->user();
          $image = $user->image;
          $imagee = public_path('images/users/' . $image);
          if ($image != null) {
            unlink($imagee);// delete photo from directory
          }
        $data['image'] = null;
      $user->update($data);
    return $this->sendResponse($user);

  }

  public function updatePassword(Request $request)
  {
    $request->validate([

      'current_password' => ['required', new MatchOldPassword()],

      'new_password' => ['required'],

      'new_confirm_password' => ['same:new_password'],

    ]);

    User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
    return response()->json(['data' => "successfully " , 'success' => true] , 200);

  }
}
