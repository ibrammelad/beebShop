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
        <h4>Order View</h4>
        <br>

      </div>
      <div class="action-row mr-auto">
        <a href="/admin/orders" class="btn btn-light">Back</a>
        @if($order->status != 5 && $order->status != 6)
        <a href="/admin/order-edit/{{$order->id}}" class="btn btn-primary">Edit</a>
        @endif
        <a href="/admin/order-delete/{{$order->id}}" class="btn btn-danger">Delete</a>
      </div>
      <div class="page=form">
        <fieldset class="fieldset mb-3">
          <legend>
            <h5>Order Details</h5>
          </legend>
          <div class="fieldset-body">
            <div class="row">
              <div class="col-md-4 form-group data-view">
                <label class="title">Date</label>
                <span class="data">{{$order->created_at->format('d M Y')}}</span>
              </div>
              <div class="col-md-4 form-group data-view">
                <label class="title">Payment</label>
                <span class="data">Cash On Delivery</span>
              </div>
              <div class="col-md-4 form-group data-view">
                <label class="title">Delivery Man</label>
                @if($order->delivery_id != null)
                  <span class="data">{{$order->Delivery->name}}</span>
                @else
                  <span class="data">not selected yet</span>
                @endif
              </div>
              <div class="col-md-4 form-group data-view">
                <label class="title">Status</label>
                @if($order->status == 1)
                  <span class="data">New Order</span>
                @elseif($order->status == 2)
                  <span class="data">Preparing</span>
                @elseif($order->status == 3)
                  <span class="data">On Hold</span>
                @elseif($order->status == 4)
                  <span class="data">On The Way</span>
                @elseif($order->status == 5)
                  <span class="data">Delivered</span>
                @elseif($order->status == 6)
                  <span class="data">Cancelled</span>
                @endif
              </div>
              <div class="col-md-4 form-group data-view">
                <label class="title">Reward Points</label>
                @if($order->reward_points != null)
                  <span class="data">{{$order->reward_points}}</span>
                @else
                  <span class="data">0</span>
                @endif
              </div>
              {{--                            <div class="col-md-4 form-group data-view">--}}
              {{--                                <label class="title">Invoice</label>--}}
              {{--                                <span class="data">In21000725</span>--}}
              {{--                            </div>--}}
            </div> <!-- Row End -->

          </div>
        </fieldset>
        <fieldset class="fieldset mb-3">
          <legend>
            <h5>Customer Information</h5>
          </legend>
          <div class="fieldset-body">
            <div class="row">
{{--              <div class="col-md-4 form-group data-view">--}}
{{--                <label class="title">Store</label>--}}
{{--                <span class="data">Value Here</span>--}}
{{--              </div>--}}
{{--              <div class="col-md-4 form-group data-view">--}}
{{--                <label class="title">Currency</label>--}}
{{--                <span class="data">Value Here</span>--}}
{{--              </div>--}}
{{--              <div class="col-md-4 form-group data-view">--}}
{{--                <label class="title">Customer Group</label>--}}
{{--                <span class="data">Value Here</span>--}}
{{--              </div>--}}
              <div class="col-md-4 form-group data-view">
                <label class="title">Full Name</label>
                <span class="data">{{$order->user->name}}</span>
              </div>
              <div class="col-md-4 form-group data-view">
                <label class="title">Email</label>
                <span class="data">{{$order->user->email}}</span>
              </div>
              <div class="col-md-4 form-group data-view">
                <label class="title">Mobile Number</label>
                <span class="data">{{$order->user->phone}}</span>
              </div>
            </div> <!-- Row End -->

          </div>
        </fieldset>
        <fieldset class="fieldset mb-3">
          <legend>
            <h5>Address</h5>
          </legend>
          <div class="fieldset-body">
            <div class="row">
              <div class="col-md-4 form-group data-view">
                @if($order->place_id != null)
                  <label class="title">address</label>
                  <span class="data">Order Place : {{$order->orderPlace->name}}</span>
                @else
                  <label class="title">address</label>
                  <span class="data">Address : {{$order->address}}</span>
                @endif
              </div>
              {{--                            <div class="col-md-4 form-group data-view">--}}
              {{--                                <label class="title">Street</label>--}}
              {{--                                <span class="data">25 Elhussin St.</span>--}}
              {{--                            </div>--}}
              {{--                            <div class="col-md-4 form-group data-view">--}}
              {{--                                <label class="title">Country</label>--}}
              {{--                                <span class="data">Jorden</span>--}}
              {{--                            </div>--}}
            </div> <!-- Row End -->

          </div>
        </fieldset>
      </div>
      <div class="page-list">
        <fieldset class="fieldset mb-3">
          <legend>
            <h5>Order Items</h5>
          </legend>
          <div class="fieldset-body">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                <tr>
                  <th>
                    Product Name
                  </th>
                  <th>
                    Description
                  </th>
                  <th>
                    Unit Price
                  </th>
                  <th>
                    Quantity
                  </th>
                  <th>
                    Quantity type
                  </th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->ShoppingCart as $cart)
                  <tr>

                    <td>
                        <span class="td-data">
                          {{$cart ->item->name}}
                        </span>
                    </td>
                    <td>
                        <span class="td-data">
                          {{$cart->item->description}}
                        </span>
                    </td>
                    <td>
                        <span class="td-data">
                            {{$cart->item ->price}}
                        </span>
                    </td>
                    <td>
                        <span class="td-data">
                            {{$cart ->quantity}}
                        </span>
                    </td>
                    <td>
                        <span class="td-data">
                            {{$cart->item  ->quantity_type}}
                        </span>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </fieldset>
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
                          <div class="col-md-12 form-group">
                              <p>
                                  1Kg rice, 2Kg Tomate, 1 Pice Tea 250G
                              </p>
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
                                  </label>
                                  <select class="select2-modal2 form-control">
                                      <option>Alabama</option>
                                      <option>Wyoming</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-12 form-group">
                              <div class="control-container">
                                  <label class="control-lable">
                                      <span class="title">Quantity</span>
                                      <!-- To hide validate span add class "hide" -->
                                  </label>
                                  <input class="form-control" placeholder="Enter Quantity">
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save</button>
                  </div>
              </div>
          </div>
      </div>
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
                                      <!-- To hide validate span add class "hide" -->
                                  </label>
                                  <input class="form-control" placeholder="Enter Quantity">
                              </div>
                          </div>
                          <div class="col-md-12 form-group">
                              <div class="control-container">
                                  <label class="control-lable">
                                      <span class="title">Notes</span>
                                      <!-- To hide validate span add class "hide" -->
                                  </label>
                                  <textarea class="form-control" placeholder="Enter Notes"></textarea>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save</button>
                  </div>
              </div>
          </div>
      </div>

  {{--    <script src="{{asset('new/js/jquery-3.2.1.js')}}"></script>--}}
  <script src="{{asset('new/js/propper.min.js')}}"></script>
  <script src="{{asset('new/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('new/js/jquery-ui.min.js')}}"></script>
  <script src="{{asset('new/js/select2.min.js')}}"></script>
  <script src="{{asset('new/js/script.js')}}"></script>
@endsection
