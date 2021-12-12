<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderPlace;
use Illuminate\Http\Request;

class OrderPlaceController extends Controller
{
  public function __construct()
  {
    $this->middleware(['role_or_permission:super admin|view_order|modify_order'])->only('order_places');
    $this->middleware(['role_or_permission:super admin|modify_order'])->except('order_places');
  }
      public function order_places()
      {
        $places = OrderPlace::paginate(20);
        return view('admin.pages.orders.order-places' , compact('places'));
      }

      public function order_places_create()
      {
        return view('admin.pages.orders.order-places-form');

      }

      public function order_places_store(Request $request)
      {

        $this->validate($request, [
          'name' => 'required|max:255',
          'cost' => 'required|numeric',
          'status' => 'required|in:0,1' ,
        ]);
        $data = $request->except('_token');
        OrderPlace::create($data);
        return redirect()->route('order_places_index')->with(['success' => "add order place successfully"]);
      }


      public function order_places_edit($id)
      {
        $place = OrderPlace::findOrFail($id);
        return view('admin.pages.orders.order-places-edit' , compact('place'));

      }

      public function order_places_update(Request  $request,$id)
      {
        $this->validate($request, [
          'name' => 'max:255',
          'status' => 'in:0,1' ,
        ]);
        $place = OrderPlace::findOrFail($id);
        $data = $request->except('_token');
        $place->update($data);
        return redirect()->route('order_places_index')->with(['success' => "update order place successfully"]);

      }

      public function order_places_destroy($id)
      {
        $place = OrderPlace::findOrFail($id);
        $place->delete();
        return redirect()->route('order_places_index')->with(['success' => "delete order place successfully"]);

      }


}
