@extends('admin.layouts.contentLayoutMaster')
{{-- page title --}}
@section('title',' Orders List')
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
  <!-- users list start -->
  <section class="users-list-wrapper">
    <div class="users-list-table">
      <div class="card">
        <div class="card-body">
          <div class="col-12 d-flex align-items-center justify-content-end pb-1">

            <div class="page-list">
            <div class="page-title">
                <h3>Orders</h3>
            </div>
            @include('admin.layouts.alerts.success')
            @include('admin.layouts.alerts.errors')

            <!-- Add and delete form  -->
            <div class="page=form">

              <fieldset class="fieldset">
                <legend>
                  <h5>Filter Orders</h5>
                </legend>
                <form method="get" action="{{route('SearchSortOrders')}}">
                  <div class="fieldset-body">
                    <div class="row">

                      <div class="col-md-4 form-group">
                        <div class="control-container">
                          <label class="control-lable">
                            <span class="title">Date From</span>
                            <!-- To hide validate span add class "hide" -->
                          </label>
                          <input name="date1" class="form-control datepicker-input" type="text" placeholder="selecte date">
                        </div>
                      </div>
                      <div class="col-md-4 form-group">
                        <div class="control-container">
                          <label class="control-lable">
                            <span class="title">Date To</span>
                           <!-- To hide validate span add class "hide" -->
                          </label>
                          <input name="date2" class="form-control datepicker-input" type="text" placeholder="selecte date">
                        </div>
                      </div>
                      <div class="col-md-4 form-group">
                        <div class="control-container">
                          <label class="control-lable">
                            <span class="title">Order Type</span>
                            <!-- To hide validate span add class "hide" -->
                          </label>
                          <select  name="status" class="form-control">
                            <option value="1">New Order</option>
                            <option value="2">Preparing</option>
                            <option value="3">On Hold</option>
                            <option value="4">On The Way</option>
                            <option value="5">Delivered</option>
                            <option value="6">Canceld</option>
                          </select>
                        </div>
                      </div>
                    </div> <!-- Row End -->

                    <div class="action-row">
                      <input type="submit" class="btn btn-primary" value="Search">
                      <a class="btn btn-light">Clear</a>
                    </div>
                  </div>
                </form>
              </fieldset>
            </div>
            <div class="page-list">
                <h5 class="form-group">List Of Orders</h5>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    Order No.
                                </th>
                                <th>
                                    Order Info
                                </th>
                                <th>
                                    Deliver Address
                                </th>

                                <th>
                                    Order Cost
                                </th>
                                <th>
                                    Status
                                </th>
                                <th class="th-actions">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>

                                <td>
                                    <span class="td-data">
                                        100{{$order->id}}
                                    </span>
                                </td>
                                <td>

                                  <span class="td-data">
                                       <a class="btn btn-link" data-target="#orderInfoModal" data-toggle="modal">
                                       {{$order->user->name}} ,
                                       </a>
                                  </span>


                                      <!-- Order Info modal -->
                                      <div class="modal fade" id="orderInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                           aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLongTitle">Order Info</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">*</span>
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


                                </td>
                                <td>
                                  @if($order->place_id != null)
                                    <span class="data"> order place : {{$order->orderPlace->name}}</span>
                                  @else
                                    <span class="data">{{$order->address}}</span>
                                  @endif

                                </td>

                                <td>
                                    <span class="td-data">
                                        {{$order->order_cost}}
                                    </span>
                                </td>

                              <td>
                                            @if($order->status == 1)
                                    <span class="data" >New Order</span>
                                  @elseif($order->status == 2)
                                    <span class="data"  >Preparing</span>
                                  @elseif($order->status == 3)
                                    <span class="data"  >On Hold</span>
                                  @elseif($order->status == 4)
                                    <span class="data"  >On The Way</span>
                                  @elseif($order->status == 5)
                                    <span class="data"  >Delivered</span>
                                  @elseif($order->status == 6)
                                    <span class="data"  >Cancelled</span>
                                  @endif
                              </td>
                                <td class="td-actions-group">
                                    <div class="actions">
                                        <a href="/admin/order-view/{{$order->id}}" class="table-action-btn" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                      @if($order->status != 5 && $order->status != 6)
                                        <a href="/admin/order-edit/{{$order->id}}" class="table-action-btn" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a class="table-action-btn" title="Assign to delivery"
                                           data-target="#assignDeliveryModal" data-toggle="modal">
                                          <i class="fas fa-truck"></i>
                                        </a>
                                      @endif

                                        <a href="/admin/order-delete/{{$order->id}}" class="table-action-btn text-danger" title="Remove">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                  {{ $orders->links() }}

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
                        <div class="col-md-12 form-group">
                            <p>
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

    <!-- Assign Delivery modal -->
{{--    <div class="modal fade" id="assignDeliveryModal" tabindex="-1" role="dialog"--}}
{{--        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
{{--        <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="exampleModalLongTitle">Assign order to delivery man</h5>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-12 form-group">--}}
{{--                            <div class="control-container">--}}
{{--                                <label class="control-lable">--}}
{{--                                    <span class="title">Select delivery man</span>--}}
{{--                                </label>--}}
{{--                                <select class="select2-modal form-control">--}}
{{--                                    <option>Alabama</option>--}}
{{--                                    <option>Wyoming</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>--}}
{{--                    <button type="button" class="btn btn-primary">Assign</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


        </div></div></div></section>

@endsection
@section('vendor-scripts')
{{--  <script src="{{asset('new/js/jquery-3.2.1.js')}}"></script>--}}
  <script src="{{asset('new/js/propper.min.js')}}"></script>
  <script src="{{asset('new/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('new/js/jquery-ui.min.js')}}"></script>
  <script src="{{asset('new/js/select2.min.js')}}"></script>
  <script src="{{asset('new/js/script.js')}}"></script>
@endsection
