<?php

namespace App\Http\Controllers\Api\OrderOperation;

use App\Http\Controllers\Api\ResponseController;
use App\Http\Controllers\Controller;
use App\Models\BestSeller;
use App\Models\Order;
use App\Models\Review;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderOperationController extends ResponseController
{
  public function FollowOperationShopping()
  {
    $user_id = auth()->user()->id;
    $myCart = ShoppingCart::where('user_id', $user_id)->where('order_id', null)->get();

    if (!$myCart->isEmpty()) {
      DB::beginTransaction();
      $order = Order::create([
        'user_id' => $user_id,
        'status' => 1,
      ]);
      $items = [];
      foreach ($myCart as $index => $cart) {
        $cart->update([
          'order_id' => $order->id
        ]);
        $thisItem = $cart->item->first();
        $thisItem->update([
          'quantity' => ($thisItem->quantity) - ($cart->quantity)
        ]);
        $items[$index] = ["item " . ($index + 1) => $cart->item, 'quantityItem' => $cart->quantity];
      }

      DB::commit();
      return response()->json(["data" => ["items" => $items, "order_id" => $order->id], "status" => 200], 200);
    } else {
      return $this->sendError("404", "ShoppingCart is Empty ");
    }
  }

  public function ensureOrder(Request $request, $id)
  {
    $order = Order::findOrFail($id);
    $items = $order->ShoppingCart()->with('item')->get()->pluck('item');
    $rules = [
      'place_id' => 'exists:order_places,id',
      'address' => 'string',
      'order_cost' => 'required'
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      return $this->sendError("404", [$validator->errors()]);
    }
    $data = $request->all();
    $data['status'] = 2;
    DB::beginTransaction();
    $order->update($data);
    foreach ($items as $item) {
      $best = BestSeller::where("item_id", $item->id)->get();
      if ($best->isEmpty()) {
        BestSeller::create([
          "item_id" => $item->id,
          "frequency" => 1
        ]);
      } else
        $best->first()->update([
          "frequency" => $best->first()->frequency + 1
        ]);

    }
    DB::commit();
    return $this->sendResponse($order);
  }


}
