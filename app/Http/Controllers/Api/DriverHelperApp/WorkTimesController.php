<?php

namespace App\Http\Controllers\Api\DriverHelperApp;

use App\Http\Controllers\Api\ResponseController;
use App\Http\Controllers\Controller;
use App\Models\WorkTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function Matrix\trace;

class WorkTimesController extends ResponseController
{

  public function index()
  {
    $me = auth()->guard('work')->user();
    $myTimes = WorkTime::where("worker_id", $me)->simplePaginate();
    return $this->sendResponse($myTimes);
  }


  public function store(Request $request)
  {
    try {
      $rules = [
        'day' => 'required',
        'from' => 'required',
        'to' => 'required',
      ];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        return $this->sendError("404", [$validator->errors()]);
      }
      $data = $request->all();
      $me = auth()->guard('work')->user();
      $data['worker_id'] = $me->id;
      $workTime = WorkTime::create($data);
      $success = $workTime->with('worker')->first();
      return $this->sendResponse($success);
    } catch (\Exception $exception) {
      $message = $exception->getMessage();
      return $this->sendError('404', [$message]);
    }

  }


  public function update(Request $request, $id)
  {
    try {
      $mytime = WorkTime::where('id', $id)->first();
      $data = $request->all();
      $mytime->update($data);
      $success = $mytime->with('worker')->first();
      return $this->sendResponse($success);
    } catch (\Exception $exception) {
      $message = $exception->getMessage();
      return $this->sendError('404', [$message]);
    }

  }


  public function destroy($id)
  {
      $mytime = WorkTime::where('id', $id)->first();
      if ($mytime != null) {
        $mytime->delete();
        return $this->sendResponse("delete Successfully");
      }
      else
        return $this->sendError('404',"sorry not Fount ");


    }
}
