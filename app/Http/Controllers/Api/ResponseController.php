<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
class ResponseController extends Controller
{

  public function sendResponse($result)
  {
    $response = [
      'success' => true,
      'data'    => $result,
      //'message' => $message,
    ];


    return response()->json($response, 200);
  }


  public function sendError($error, $errorMessages = [], $code = 404)
  {
    $response = [
      'success' => false,
      'message' => $error,
    ];


    if(!empty($errorMessages)){
      $response['data'] = $errorMessages;
    }

    return response()->json($response, $code);
  }



}
