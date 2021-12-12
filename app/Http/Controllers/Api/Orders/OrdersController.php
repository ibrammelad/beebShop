<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Api\ResponseController;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends ResponseController
{
      public function myOrder()
      {
        $user_id = auth()->user()->id ;
        $orders =  Order::where('user_id' ,$user_id )->simplePaginate(20);
        return $this->sendResponse($orders );
      }

      public function showOrder($id)
      {
        $user_id = auth()->user()->id ;
        $orders =  Order::where('user_id' ,$user_id )->where('id' ,$id)->simplePaginate(20);
        return $this->sendResponse($orders);
      }

      public function Preparing()
      {
        $user_id = auth()->user()->id ;
        $orders =  Order::where('user_id' ,$user_id )->where('status' , 2)->simplePaginate(20);
        return $this->sendResponse($orders ,);
      }

      public function Cancelled()
      {
        $user_id = auth()->user()->id ;
        $orders =  Order::where('user_id' ,$user_id )->where('status' , 6)->simplePaginate(20);
        return $this->sendResponse($orders ,);
      }

      public function Delivered()
      {
        $user_id = auth()->user()->id ;
        $orders =  Order::where('user_id' ,$user_id )->where('status' , 5)->simplePaginate(20);
        return $this->sendResponse($orders ,);
      }

}
