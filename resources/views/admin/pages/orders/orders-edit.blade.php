@extends('admin.layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Create Edit')
{{-- vendor styles --}}
@section('vendor-styles')
  <link rel="stylesheet" type="text/css" href="{{asset('new/css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('new/css/jquery-ui.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('new/css/all.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('new/css/select2.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('new/css/style.css')}}">
@endsection

{{-- page styles --}}
@section('page-styles')
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-users.css')}}">
@endsection

@section('content')
  <!-- users edit start -->
  {{--  <section class="users-edit mt-5">--}}
    <div class="card">
      @include('admin.layouts.alerts.success')
      @include('admin.layouts.alerts.errors')
      <div class="page-content">
        <div class="page-title">
          <h4>Order Edit</h4>

        </div>
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Customer Information</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Payment & Shipping</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Order Items</a>
          </li>
        </ul><!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="tabs-1" role="tabpanel">
            <div class="row">
              {{--                        <div class="col-md-4 form-group">--}}
              {{--                            <div class="control-container">--}}
              {{--                                <label class="control-lable">--}}
              {{--                                    <span class="title">Store</span>--}}
              {{--                                    <span class="text-danger validate">Required</span>--}}
              {{--                                </label>--}}
              {{--                                <select class="select2 form-control">--}}
              {{--                                    <option>Alabama</option>--}}
              {{--                                    <option>Wyoming</option>--}}
              {{--                                </select>--}}
              {{--                            </div>--}}
              {{--                        </div>--}}
              {{--                        <div class="col-md-4 form-group">--}}
              {{--                            <div class="control-container">--}}
              {{--                                <label class="control-lable">--}}
              {{--                                    <span class="title">Currency</span>--}}
              {{--                                    <span class="text-danger validate">Required</span>--}}
              {{--                                </label>--}}
              {{--                                <select class="select2 form-control">--}}
              {{--                                    <option>دينار أردني</option>--}}
              {{--                                    <option>دولار</option>--}}
              {{--                                </select>--}}
              {{--                            </div>--}}
              {{--                        </div>--}}
              {{--                        <div class="col-md-4 form-group">--}}
              {{--                            <div class="control-container">--}}
              {{--                                <label class="control-lable">--}}
              {{--                                    <span class="title">Customer Group</span>--}}
              {{--                                    <span class="text-danger validate">Required</span>--}}
              {{--                                </label>--}}
              {{--                                <select class="select2 form-control">--}}
              {{--                                    <option>Group 1</option>--}}
              {{--                                    <option>Group 2</option>--}}
              {{--                                </select>--}}
              {{--                            </div>--}}
              {{--                        </div>--}}
              <div class="col-md-4 form-group">
                <div class="control-container">
                  <label class="control-lable">
                    <span class="title">Name</span>
                    <!-- To hide validate span add class "hide" -->
                  </label>
                  <input class="form-control" placeholder="{{$order->user->name}}" value="{{$order->user->name}}">
                </div>
              </div>
              <div class="col-md-4 form-group">
                <div class="control-container">
                  <label class="control-lable">
                    <span class="title">Email</span>
                  {{--                                    <span class="text-danger validate">Required</span>--}}
                  <!-- To hide validate span add class "hide" -->
                  </label>
                  <input class="form-control" placeholder="{{$order->user->email}}" value="{{$order->user->email}}">
                </div>
              </div>
              <div class="col-md-4 form-group">
                <div class="control-container">
                  <label class="control-lable">
                    <span class="title">Mobile Number</span>
                    <!-- To hide validate span add class "hide" -->
                  </label>
                  <input class="form-control" placeholder="{{$order->user->phone}}" value="{{$order->user->phone}}">
                </div>
              </div>
            </div> <!-- Row End -->
          </div>

          <div class="tab-pane" id="tabs-2" role="tabpanel">
            <form id="form" method="post" action="{{route('order-update' , $order->id)}}">
              @csrf
            <div class="action-row mr-auto">
              <button type="submit" name="update_order" class="btn btn-primary" >Save</button>
              <a href="/admin/orders" class="btn btn-light">Cancel</a>
            </div>

            <div class="row">
              <div class="col-md-4 form-group">
                <div class="control-container">
                  <label class="control-lable">
                    <span class="title">Payment</span>
{{--                    <span class="text-danger validate">Required</span>--}}
                  </label>
                  <select class="select2 form-control">
                    <option selected>Cash On Delivery</option>

                  </select>
                </div>
              </div>
{{--              <div class="col-md-4 form-group">--}}
{{--                <div class="control-container">--}}
{{--                  <label class="control-lable">--}}
{{--                    <span class="title">Order Status</span>--}}
{{--                    --}}{{--                                    <span class="text-danger validate">Required</span>--}}
{{--                  </label>--}}
{{--                  <select name="status" class="form-control">--}}
{{--                    @if($order->status == 1)--}}
{{--                      <option value="1">New Order</option>--}}
{{--                    @elseif($order->status == 2)--}}
{{--                      <option value="2">Preparing</option>--}}
{{--                    @elseif($order->status == 3)--}}
{{--                      <option value="3">On Hold</option>--}}
{{--                    @elseif($order->status == 4)--}}
{{--                      <option value="4">On The Way</option>--}}
{{--                    @elseif($order->status == 5)--}}
{{--                      <option value="5">Delivered</option>--}}
{{--                    @elseif($order->status == 6)--}}
{{--                      <option value="6">Cancelled</option>--}}
{{--                    @endif--}}
{{--                    <option value="3">On Hold</option>--}}
{{--                    <option value="2">Preparing</option>--}}
{{--                    <option value="4">On The Way</option>--}}
{{--                    <option value="6">Canceld</option>--}}
{{--                  </select>--}}

{{--                </div>--}}
{{--              </div>--}}
              @if($order->place_id != null)
                <div class="col-md-4 form-group">
                  <div class="control-container">
                    <label class="control-lable">
                      <span class="title">Helper Man</span>
                    </label>
                    <select class="select2 form-control" name="delivery_id">
                      @if($order->delivery_id  != null)
                        <option value="{{$order->delivery_id}}"> {{$order->Delivery->name}}</option>
                      @else
                        <option value=""></option>

                      @endif
                      @foreach($helpers as $helper )
                        <option value="{{$helper->id}}"> {{$helper->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4 form-group">
                  <div class="control-container">
                    <label class="control-lable">
                      <span class="title">Order Place </span>
                      {{--                              <span class="text-danger validate"></span>--}}
                    </label>
                    <select class="select2 form-control" name="place_id">
                      <option value="{{$order->place_id}}" selected>{{$order->orderPlace->name}}</option>
                      @foreach($orderPlaces as $orderPlace)
                        <option value="{{$orderPlace->id}}"> {{$orderPlace->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              @else
                <div class="col-md-4 form-group">
                  <div class="control-container">
                    <label class="control-lable">
                      <span class="title">Driver Man</span>
                    </label>
                    <select class="select2 form-control" name="delivery_id">
                      @if($order->delivery_id  != null)
                        <option value="{{$order->delivery_id}}"> {{$order->Delivery->name}}</option>
                      @else
                        <option value=""></option>
                      @endif
                      @foreach($drivers as $driver )
                        <option value="{{$driver->id}}"> {{$driver->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="col-md-4 form-group">
                  <div class="control-container">
                    <label class="control-lable">
                      <span class="title">Address </span>
                    </label>
                    <input type="text" class="form-control" value="{{$order->address}}" name="address">
                  </div>
                </div>

                <div class="col-md-4 form-group">
                  <div class="control-container">
                    <label class="control-lable">
                      <span class="title">City</span>
                    </label>
                    <select required class="select2 form-control" name="city_id">
                      @if($order->city_id  != null)
                        <option value="{{$order->city_id}}"> {{$order->city->name}}</option>
                      @else
                        <option value=""></option>
                      @endif
                      @foreach($orderCities as $city )
                        <option value="{{$city->id}}"> {{$city->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

              @endif
              <div class="col-md-4 form-group">
                <div class="control-container">
                  <label class="control-lable">
                    <span class="title">Driver Percentage </span>
                    <!-- To hide validate span add class "hide" -->
                  </label>

                  <input  class="form-control" value="@if($financial != null) {{$financial->persentDriver}}@else  @endif " name="persentDriver">
                </div>
                @error("persentDriver")
                <span class="text-danger">this field is required</span>
                @enderror
              </div>

            </div></form>
             <!-- Row End -->
          </div>
          <div class="tab-pane" id="tabs-3" role="tabpanel">
            <div class="action-row">
              <a class="btn btn-primary" data-target="#AddNewItem" data-toggle="modal"><i class="fas fa-plus"></i> Add
                New</a>
            </div>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                <tr>
                  <th>
                    Product Name
                  </th>
                  <th>
                    Quantity
                  </th>
                  <th>
                    Unit Price
                  </th>
                  <th>
                    Total
                  </th>
                  <th class="th-actions">
                    Actions
                  </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  @foreach($order->ShoppingCart as $cart)
                    <form id="form1" action="{{route('updateCartOrder',$cart->id)}}"  method="post" enctype="multipart/form-data" >
                      @csrf

                  <td>
                        <span class="td-data">
                            <a class="btn btn-link wrap" data-target="#orderInfoModal"
                               data-toggle="modal">
                                {{$cart->item->name}}
                            </a>
                        </span>
                  </td>

                    <td>
                    <input type="number" required name="quantity" class="form-control"  id="item{{$cart->id}}" value="{{$cart->quantity}}">
                  </td>
                  <td>
                        <span class="td-data">
                            {{$cart->item->price}}
                        </span>
                  </td>
                  <td>
                        <span class="td-data">
                          {{$cart->quantity * $cart->item->price}}
                        </span>
                  </td>

                    <td class="td-actions-group">
                    <div class="actions">
                      <button type="submit" id="item{{$cart->id}}"><i class="fas fa-edit"></i></button>




                      <a href="{{route('deleteCartOrder' ,$cart->id )}}" class="table-action-btn text-danger" title="Remove">
                        <i class="fas fa-trash-alt"></i>
                      </a>
                    </div>

                  </td>
                    </form>

                </tr>

                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>


      </div>
    </div>
  <!-- Order Info modal -->
  <div class="modal fade" id="orderInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Order Info</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            order owner:<b>{{$order->user->name}}</b> /
            <div class="col-md-12 form-group">
              @foreach($order->ShoppingCart as $index=>$cart)

                <hr> Product name: <b>{{$cart->item->name}}</b> / quantity: <b>{{$cart->quantity}}</b>  /  quantity type: <b>{{$cart->item->	quantity_type}}</b>
              @endforeach
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Add New Item modal -->
  <form method="post" action="{{route('addItem' , $order->id)}}">
    @csrf
  <div class="modal fade" id="AddNewItem" tabindex="-1" role="dialog"
       aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add item to order</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12 form-group">
              <div class="control-container">
                <label class="control-lable">
                  <span class="title">Search in items</span>
{{--                  <span class="text-danger validate">Required</span>--}}
                </label>
                <select class="select2-modal2 form-control" name="item_id">
                @foreach($items as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-12 form-group">
              <div class="control-container">
                <label class="control-lable">
                  <span class="title">Quantity</span>
                  <!-- To hide validate span add class "hide" -->
                </label>
                <input class="form-control" placeholder="Enter Quantity" name="quantity">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="Save">
        </div>
      </div>
    </div>
  </div>
  </form>
  <!-- Edit Item modal -->

      <div class="modal fade" id="editItemModal" tabindex="-1" role="dialog"
           aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Edit Order</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">

                <div class="col-md-12 form-group">
                  <div class="control-container">
                    <label class="control-lable">
                      <span class="title">Quantity</span>
{{--                      <span class="text-danger validate">Required</span>--}}
                      <!-- To hide validate span add class "hide" -->
                    </label>
                    <input type="number" required name="quantity" class="form-control" placeholder="Enter Quantity">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary" value="Save">
            </div>
          </div>
        </div>
      </div>
  </form>

  {{--    <script src="{{asset('new/js/jquery-3.2.1.js')}}"></script>--}}
  <script src="{{asset('new/js/propper.min.js')}}"></script>
  <script src="{{asset('new/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('new/js/jquery-ui.min.js')}}"></script>
  <script src="{{asset('new/js/select2.min.js')}}"></script>
  <script src="{{asset('new/js/script.js')}}"></script>
@endsection
