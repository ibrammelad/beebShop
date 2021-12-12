<?php

namespace App\Http\Controllers\Api\ShoppingCart;

use App\Http\Controllers\Api\ResponseController;
use App\Models\Order;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ShoppingCartController extends ResponseController
{

      public function myCart()
      {
        $user_id = auth()->user()->id;
        $myCart  = ShoppingCart::where('user_id' , $user_id)->where('order_id' , null)->with('item')->with('user')->with('order')->simplePaginate(15);
        return $this->sendResponse($myCart);
      }

      public function addToCart(Request $request)
      {
        $rules = [
          'quantity' => 'required|numeric',
          'item_id' => 'required|exists:items,id',
          'order_id' => 'exists:orders,id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
          return $this->sendError("404" , [$validator->errors()]);
        }

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $shoppingCart = ShoppingCart::create($data);
        return $this->sendResponse($shoppingCart);

      }

      public function deleteFromCart($id)
      {
        $cart = ShoppingCart::findorFail($id);
        $cart->delete();
        return response()->json(["data"=>"deleted successfully" , "status" =>200] , 200);
      }



}
