@extends('admin.layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Question List')
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
  {{--  <section class="users-list-wrapper">--}}
  <div class="users-list-table">
    <div class="card">
      {{--      <div class="card-body">--}}
      <div class="col-12 d-flex align-items-center justify-content-end pb-1">

        <div class="page-list">
          <!-- Add and delete form  -->
          <div class="page=form">
            <fieldset class="fieldset">
              <div class="fieldset-body">
                <div class="user-info">
                  <div class="user-img">
                    <img
                      src="{{ \Illuminate\Support\Facades\URL::to('/') }}/images/drivers/{{ $driver->image!=null ? $driver->image : "download.jpg"}}"
                      alt="driver" width="100" height="100">
                  </div>
                  <div class="info">
                    <h5>{{$driver->name}}</h5>
                    <p>{{$driver->address}}</p>
                  </div>
                </div>
                @include('admin.layouts.alerts.success')
                @include('admin.layouts.alerts.errors')
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Finance
                      Summary</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Orders</a>
                  </li>
                </ul><!-- Tab panes -->
                <div class="tab-content">
                  <div class="tab-pane active" id="tabs-1" role="tabpanel">
                    <div class="page-list">
                      <div class="action-row form-group">
                        <div class="amount-info">
                          @if(!is_null($debits))
                            <h5>{{$debits->payable}}</h5>
                            <p>The amount required</p>

                          @else
                            <h5> 0 </h5>
                            <p>Dinar have to payable</p>

                          @endif

                        </div>
                        <div class="mr-5 p-5">
                          <a class="btn btn-primary" data-toggle="modal"
                             data-target="#payAllModal">Pay All</a>
                          <a class="btn btn-secondary" data-toggle="modal"
                             data-target="#depositeModal">Deposite</a>
                        </div>
                      </div>
                      <h5 class="form-group">Payment History</h5>
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                          <tr>
                            <th>
                              Date
                            </th>
                            <th>
                              Percentage Driver
                            </th>
                            <th>
                              Amount
                            </th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($financial as $fin)

                            <tr>
                              <td>
                                <span
                                  class="td-data">{{ \Illuminate\Support\Carbon::parse($fin->created_at)->format('Y-m-d')}}</span>
                              </td>
                              <td>
                                <span class="td-data">{{$fin->persentDriver}} % </span>
                              </td>
                              <td>
                                <span class="td-data">{{$fin->amountneed}}</span>
                              </td>
                            </tr>
                          @endforeach

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="tabs-2" role="tabpanel">
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
                              Total Cost
                            </th>
                            <th>
                              Actual Cost
                            </th>
                            <th>
                              Delivery Cost
                            </th>
                            <th>
                              Pay For us
                            </th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($driver->order as $order)
                            <tr>

                              <td>
                        <span class="td-data">
                              #00{{$order->id}}
                        </span>
                              </td>
                              <td>
                                    <span class="td-data">
                                      <span class="td-data">
                                                   <a class="btn btn-link" data-target="#orderInfoModal" data-toggle="modal">
                                                   {{$order->user->name}} ,
                                                   </a>
                                              </span>
                                      <div class="modal fade" id="orderInfoModal" tabindex="-1" role="dialog"
                                           aria-labelledby="exampleModalCenterTitle"
                                           aria-hidden="true">
                                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                                          <div class="modal-content">
                                                              <div class="modal-header">
                                                                  <h5 class="modal-title" id="exampleModalLongTitle">Order Info</h5>
                                                                  <button type="button" class="close" data-dismiss="modal"
                                                                          aria-label="Close">
                                                                      <span aria-hidden="true">*</span>
                                                                  </button>
                                                              </div>
                                                              <div class="modal-body">
                                                                  <div class="row">
                                                                    order owner:<b>{{$order->user->name}}</b> /
                                                                    <div class="col-md-12 form-group">
                                                                      @foreach($order->ShoppingCart as $index=>$cart)

                                                                        <hr> Product name: <b>{{$cart->item->name}}</b> / quantity:
                                                                        <b>{{$cart->quantity}}</b>  /  quantity type:
                                                                        <b>{{$cart->item->	quantity_type}}</b>
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


                                    </span>
                              </td>
                              <td>
                                    @if($order->place_id != null)
                                      <span class="data"> order place : {{$order->orderPlace->name}}</span>
                                    @else
                                      <span class="data">{{$order->address}}</span>
                                    @endif
                              </td>

                              <td>
                                    <span
                                    class="td-data">
                                    {{$order->financialWork->total_cost}}

                                    </span>
                              </td>
                              <td>
                                    <span
                                      class="td-data">
                                      {{$order->financialWork->actual_cost}}

                                    </span>
                              </td>
                              <td>
                                @if($order->place_id != null)
                                  <span class="data"> order place : {{$order->orderPlace->cost}}</span>
                                @else
                                  <span class="data">{{$order->city->cost}}</span>
                                @endif
                              </td>
                              <td>
                                <span
                                  class="td-data">
                                      {{$order->financialWork->amountneed}}
                                </span>
                              </td>
                            </tr>
                          @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </fieldset>
          </div>
        </div>
      </div>
      <!-- Pay All modal -->
      <form method="post" action="{{route('payAll_route' , $driver->id)}}">
        @csrf
        <div class="modal fade" id="payAllModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"> pay all money must to payable ?????</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Pay All</button>
              </div>
            </div>
          </div>
        </div>
      </form>
      <!-- Deposite modal -->
      <form method="post" action="{{route('payPart_route' , $driver->id)}}">
        @csrf
        <div class="modal fade" id="depositeModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Deposite</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">

                  <div class="col-md-12 form-group">
                    <div class="control-container">
                      <label class="control-lable">
                        <span class="title">Amount</span>
                        <!-- To hide validate span add class "hide" -->
                      </label>
                      <input class="form-control" type="text" placeholder="Deposite Amount" name="amount">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Deposite</button>
              </div>
            </div>
          </div>
        </div>
      </form>
      {{--<script src="{{asset('new/js/jquery-3.2.1.js')}}"></script>--}}
      <script src="{{asset('new/js/propper.min.js')}}"></script>
      <script src="{{asset('new/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('new/js/jquery-ui.min.js')}}"></script>
      <script src="{{asset('new/js/select2.min.js')}}"></script>
      <script src="{{asset('new/js/script.js')}}"></script>
    </div>
  </div>
@endsection
