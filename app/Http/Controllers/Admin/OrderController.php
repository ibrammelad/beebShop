<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\FinancialWork;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderPlace;
use App\Models\OrderRequest;
use App\Models\ShoppingCart;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public function __construct()
    {
      $this->middleware(['role_or_permission:super admin|view_order|modify_order'])->only('end_order' , 'index');
      $this->middleware(['role_or_permission:super admin|modify_order'])->except('end_order' , 'index');

    }
    public function end_order()
    {
      $orders = Order::where('status' ,5 )->orWhere('status' , 6)->paginate(20);
      return view('admin.pages.orders.ended-orders' , compact('orders'));

    }


    public function index()
    {

      $orders = Order::paginate(20);
      return view('admin.pages.orders.orders' , compact('orders'));

    }

    public function order_view($id)
  {
    $order = Order::findOrFail($id);
    return view('admin.pages.orders.orders-view' , compact('order'));

  }

  public function order_edit($id)
    {
      $order = Order::findOrFail($id);
      $helpers = Work::where('is_helper' , 1 )->where('is_driver' ,'!=' ,1 )->get();
      $drivers = Work::where('is_driver' , 1) ->get();
      $orderPlaces = OrderPlace::all();
      $orderCities = City::all();
      $items = Item::all();
      $financial = FinancialWork::where('order_id' ,$order->id)->first();
      return view('admin.pages.orders.orders-edit' , compact('order' ,'financial', 'helpers' ,'orderCities', 'drivers' , 'items','orderPlaces'));

    }

    public function order_update(Request $request , $id)
    {
      DB::beginTransaction();
      $this->validate($request , [
        'persentDriver' =>'required|numeric'
      ]);
      $data =  $request->except('_token' , 'persentDriver');
      $data['status'] = 3 ;
      $order = Order::findOrFail($id);
      $items = $order->ShoppingCart()->with('item')->get()->pluck('item')->unique('id')->values();
      $actual_price = 0;
      $total_price = 0;
      foreach ($items as $item){
        $min = min(min($item->cost1 , $item->cost2) , $item->cost3);
        $total_price = $total_price+round($item->price*(1-($item->discount/100)) , 2);
        $actual_price = $actual_price+$min;
      }
      if ($request->has('city_id'))
      {
        $city = City::where('id' ,$request->city_id)->first();
        $cityCost = $city->cost ;
      } else {
        $city = OrderPlace::where('id', $request->place_id)->first();
        $cityCost = $city->cost;
      }
      $amountNeed = round(($total_price-$actual_price) + ($cityCost - ($cityCost*($request->persentDriver/100))),2);
      if($request->has('delivery_id'))
      {
        $requestOrder = OrderRequest::where('order_id' , $order->id)->first();
        if (is_null($requestOrder))
        {
          OrderRequest::create([
            'work_id' =>$request->delivery_id,
            'order_id' => $order->id,
            'status'  =>0,
          ]);
          FinancialWork::create([
            'work_id' =>$request->delivery_id,
            'order_id' => $order->id,
            'total_cost' => $total_price,
            'actual_cost' =>$actual_price,
            'persentDriver'=>$request->persentDriver,
            'amountneed' =>$amountNeed
            ]);
        }
      }
      $order->update($data);
      DB::commit();
      return redirect()->route('order-edit', $order->id)->with(['success'=>'order update  successfully']);

    }

    public function order_delete($id)
    {
      $order = Order::findOrFail($id);
      $order->delete();
      return redirect()->route('orders_index')->with(['success'=>'delete is successfully']);
    }

    public function addItem(Request  $request , $id)
    {
      $order = Order::findOrFail($id);

      $rules =[
          'item_id' => 'required|exists:items,id' ,
          'quantity' => 'required|numeric' ,
        ];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()){
        return redirect()->route('order-edit', $order->id)->with(['error'=>"some errors occur try again"]);
      }
       $data = $request->except('_token');
       $data['order_id'] = $order->id ;
       $data['user_id'] = $order->user_id;
       ShoppingCart::create($data);
       return redirect()->route('order-edit', $order->id)->with(['success'=>'add item and order update  successfully']);

    }

    public function updateCart(Request  $request , $id)
    {
      $cart = ShoppingCart::findOrfail($id);
      $rules =[
          'quantity' => 'required|numeric' ,
        ];
      $this->validate($request ,$rules);
      $data = $request->except('_token');
      $cart->update($data);
       return redirect()->route('order-edit', $cart->order->id)->with(['success'=>'add Product and order update  successfully']);



    }

    public function deleteCart(Request $request , $id)
    {
      $cart = ShoppingCart::findOrfail($id);
      $cart->delete();
      return redirect()->route('order-edit', $cart->order->id)->with(['success'=>'delete product and order update  successfully']);
    }

}
