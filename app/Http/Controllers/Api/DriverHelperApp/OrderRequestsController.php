<?php

namespace App\Http\Controllers\Api\DriverHelperApp;

use App\Http\Controllers\Api\ResponseController;
use App\Http\Controllers\Controller;
use App\Models\Debit;
use App\Models\Order;
use App\Models\OrderRequest;
use Illuminate\Http\Request;

class OrderRequestsController extends ResponseController
{
  public function MyRequestOrders()
  {
    $worker = auth()->guard('work')->user();
    $requests = OrderRequest::where('work_id', $worker->id)->where('status', 0)->with('order.ShoppingCart.item')->with('order.financialWork')->with('work')->simplePaginate(15);
    return $this->sendResponse($requests);
  }

  public function AcceptRequestOrders()
  {
    $worker = auth()->guard('work')->user();
    $requests = OrderRequest::where('work_id', $worker->id)->where('status', 1)->with('order.ShoppingCart.item')->with('order.financialWork')->with('work')->simplePaginate(15);
    return $this->sendResponse($requests);
  }

  public function RefuseRequestOrders()
  {
    $worker = auth()->guard('work')->user();
    $requests = OrderRequest::where('work_id', $worker->id)->where('status', 2)->with('order.ShoppingCart.item')->with('order.financialWork')->with('work')->simplePaginate(15);
    return $this->sendResponse($requests);
  }

  public function acceptRequest($id)
  {
    $request = OrderRequest::findOrFail($id);
    $request->update([
      'status' => 1,
    ]);
    $order = Order::find($request->order_id);
    $order->update([
      'status' => 4
    ]);

    $response = [
      'success' => true,
      'data' => $request->with('order')->first(),
      'message' => "Accepted the order",
    ];
    return $this->sendResponse($response);
  }

  public function refuseRequest($id)
  {
    $request = OrderRequest::findOrFail($id);
    $request->update([
      'status' => 2,
    ]);
    $order = Order::find($request->order_id);
    $order->update([
      'status' => 6
    ]);
    $response = [
      'success' => true,
      'data' => $request,
      'message' => "Refused the order",
    ];
    return $this->sendResponse($response);
  }

  public function EndTheOrder($id)
  {
    $request = OrderRequest::findOrFail($id);
    $order = Order::where('id', $request->order_id)->first();
    $request->update([
      'status' => 4,
    ]);
    $order->update([
      'status' => 5,
    ]);
    $financial = $order->financialWork;
    $workDebit = Debit::where('work_id', $request->work_id,)->first();
    if (is_null($workDebit)) {
      $workDebit = Debit::create([
        'work_id' => $request->work_id,
        'payable' => $financial->amountneed
      ]);
    } else {
      $workDebit->update([
        'payable' => ($workDebit->payable + $financial->amountneed),
      ]);
    }
    return response()->json(['success' => true, "data" => $workDebit, 'message' => "order ended successfully"], 200);
  }
}
