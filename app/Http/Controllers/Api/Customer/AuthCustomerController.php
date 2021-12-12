<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Api\ResponseController;
use App\Models\Point;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Auth;
use Password;

class AuthCustomerController extends ResponseController
{
      public function register(Request $request)
      {
        ////Confirmed
        $validator = Validator::make($request->all(), [
          'name' => 'required',
          'email' => 'required|unique:users|email',
          'phone' => 'required|unique:users',
          'password' => 'required',
          'address' => 'required',
        ]);

        if($validator->fails()){
          return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $point = Point::first();
        $input['points'] = $point->register;
        $user = User::create($input);

        $success['token'] =  $user->createToken($user->name)->plainTextToken;
        $success['user'] = User::where('email' , $request->email)->first();
        return $this->sendResponse($success);
      }

      public function login(Request $request)
      {
        if (Auth::attempt(['phone' => request('email'), 'password' => request('password')]) ||
          Auth::attempt(['email' => request('email'), 'password' => request('password')]) ||
          Auth::attempt(['name' => request('email'), 'password' => request('password')]))
          {
            $user = Auth::user();
            $success['token'] = $user->createToken($user->name)->plainTextToken;
            $success['user'] = $user;

            return $this->sendResponse($success);
          } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
          }
      }

      public function registerWith(Request $request)
      {
        try{
            $user = User::where('email', $request->email)->first();
            if ($user === null) {
              $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'tokenId' => $request->token,
                'status' => 1,
                'password' => null ,
                'phone' => null ,
                'image' => null,
                'points' => 1000,
              ]);
            }
            $success['token'] =  $user->createToken($user->name)->plainTextToken;
            $success['user'] =  $user;
            return $this->sendResponse($success);
          }catch (\Exception $exception) {
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);    }
      }


//      public function forgot_password(Request $request)
//      {
//        $input = $request->all();
//        $rules = array(
//          'email' => "required|email",
//        );
//        $validator = Validator::make($input, $rules);
//        if ($validator->fails()) {
//          $arr = array("status" => false, "message" => $validator->errors()->first(), "data" => array());
//        } else {
//          try {
//            $response = Password::sendResetLink($request->only('email'));
//            switch ($response) {
//              case Password::RESET_LINK_SENT:
//                return \Response::json(array("status" => true, "message" => trans($response), "data" => array()));
//              case Password::INVALID_USER:
//                return \Response::json(array("status" => false, "message" => trans($response), "data" => array()));
//            }
//          } catch (\Swift_TransportException $ex) {
//            $arr = array("status" => false, "message" => $ex->getMessage(), "data" => []);
//          } catch (Exception $ex) {
//            $arr = array("status" => false, "message" => $ex->getMessage(), "data" => []);
//          }
//        }
//      }



}
