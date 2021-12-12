<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SearchSortController extends Controller
{
  public function __construct()
  {
    $this->middleware(['role_or_permission:super admin|view_order|modify_order']);

  }
  public function SearchSort(Request $request)
  {
    $date1=  Carbon::parse($request->date1)->format('Y-m-d') ." 00:00:00";
    $date2=  Carbon::parse($request->date2)->format('Y-m-d') ." 00:00:00";

    if ($request->status == "x")
    {
      $orders = Order::where(function($query) use ($date1 , $date2)  {
        $query->whereBetween('created_at', [$date1, $date2]);
//        $query->where('status', 5)->orWhere('status', 6);
      })->orderBy('created_at', 'desc')
        ->paginate(20);
    }
    elseif ($request->status == 5)
    {
      $orders = Order::where(function($query) use ($date1 , $date2)  {
        $query->whereBetween('created_at', [$date1, $date2]);
        $query->where('status', 5);
      })->orderBy('created_at', 'desc')
        ->paginate(20);
    }
    elseif ($request->status == 6)
    {
      $orders = Order::where(function($query) use ($date1 , $date2)  {
        $query->whereBetween('created_at', [$date1, $date2]);
        $query->where('status', 6);
      })->orderBy('created_at', 'desc')
        ->paginate(20);
    }


    return view('admin.pages.orders.ended-orders' , compact('orders'));


  }
  public function SearchSortOrders(Request $request)
  {
    $date1=  Carbon::parse($request->date1)->format('Y-m-d') ." 00:00:00";
    $date2=  Carbon::parse($request->date2)->format('Y-m-d') ." 00:00:00";

    if ($request->status == 1)
    {
      $orders = Order::where(function($query) use ($date1 , $date2)  {
        $query->whereBetween('created_at', [$date1, $date2]);
        $query->where('status', 1);
      })->orderBy('created_at', 'desc')
        ->paginate(20);
    }
    elseif ($request->status == 2)
    {
      $orders = Order::where(function($query) use ($date1 , $date2)  {
        $query->whereBetween('created_at', [$date1, $date2]);
        $query->where('status', 2);
      })->orderBy('created_at', 'desc')
        ->paginate(20);
    }elseif ($request->status == 3)
    {
      $orders = Order::where(function($query) use ($date1 , $date2)  {
        $query->whereBetween('created_at', [$date1, $date2]);
        $query->where('status', 3);
      })->orderBy('created_at', 'desc')
        ->paginate(20);
    }elseif ($request->status == 4)
    {
      $orders = Order::where(function($query) use ($date1 , $date2)  {
        $query->whereBetween('created_at', [$date1, $date2]);
        $query->where('status', 4);
      })->orderBy('created_at', 'desc')
        ->paginate(20);
    }elseif ($request->status == 5)
    {
      $orders = Order::where(function($query) use ($date1 , $date2)  {
        $query->whereBetween('created_at', [$date1, $date2]);
        $query->where('status', 5);
      })->orderBy('created_at', 'desc')
        ->paginate(20);
    }
    elseif ($request->status == 6)
    {
      $orders = Order::where(function($query) use ($date1 , $date2)  {
        $query->whereBetween('created_at', [$date1, $date2]);
        $query->where('status', 6);
      })->orderBy('created_at', 'desc')
        ->paginate(20);
    }


    return view('admin.pages.orders.orders' , compact('orders'));


  }

}
