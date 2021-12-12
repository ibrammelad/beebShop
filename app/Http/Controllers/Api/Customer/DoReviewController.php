<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Api\ResponseController;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoReviewController extends ResponseController
{
  public function doReview(Request $request)
  {

    $rules = [
      'work_id' => 'required|exists:works,id' ,
      'stars' => 'required|in:0,1,2,3,4,5',
    ]    ;
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      return $this->sendError("404", [$validator->errors()]);
    }
    $data = $request->all();
    $user = auth()->user();

    $data['user_id'] = $user->id;
    Review::create($data);

     return $this->sendResponse("reviewed successfully");


  }

  public function sendMessage(Request $request)
  {
    $user = auth()->user();
    $this->validate($request , [
      'body' => "required|string",
    ]);
    $data = $request->all();
    $data['user_id'] = $user->id;
    $message =Message::create($data);

    $response = [
      'success' => true,
      'data'    => $message,
      'message' => "message is sent successfully",
    ];

    return response()->json($response, 200);
  }
}
