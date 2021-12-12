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
  <section class="users-edit mt-5">
    <div class="card">
      @include('admin.layouts.alerts.success')
      @include('admin.layouts.alerts.errors')
        <div class="page-content">
            <div class="page-title">
                <h4>Create Order Places</h4>
            </div>
            <!-- Add and delete form  -->
            <div class="page=form">

                <fieldset class="fieldset">
                    <legend>
                        <h5>Add New Order Place</h5>
                    </legend>
                  <form method="post" action="{{route('order_places_store')}}">
                    @csrf
                    <div class="fieldset-body">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <div class="control-container">
                                    <label class="control-lable">
                                        <span class="title">Place Name</span>
                                        <!-- To hide validate span add class "hide" -->
                                    </label>
                                    <input class="form-control" name="name" placeholder="Enter place name">
                                  @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                  @endif
                                </div>
                            </div>
                          <div class="col-md-4 form-group">
                            <div class="control-container">
                              <label class="control-lable">
                                <span class="title">Delivery Cost</span>
                                <!-- To hide validate span add class "hide" -->
                              </label>
                              <input class="form-control" name="cost" placeholder="Enter delivery cost">
                              @if ($errors->has('cost'))
                                <span class="text-danger">{{ $errors->first('cost') }}</span>
                              @endif
                            </div>
                          </div>

                        </div> <!-- Row End -->
                      <div class="row">
                        <div class="col-md-4 form-group">
                          <div class="controls">
                            <label>Status</label>
                            <select required class="form-control" name="status">
                              <option value="1">Active</option>
                              <option value="0">InActive</option>
                            </select>
                            @if ($errors->has('status'))
                              <span class="text-danger">{{ $errors->first('status') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>

                        <div class="action-row">
                          <input type="submit" class="btn btn-primary" value="Save">
                            <a href="/admin/order-places" class="btn btn-light">Cancel</a>
                        </div>
                    </div>
                  </form>

                </fieldset>
            </div>
        </div>
    </div>


{{--    <script src="{{asset('new/js/jquery-3.2.1.js')}}"></script>--}}
    <script src="{{asset('new/js/propper.min.js')}}"></script>
    <script src="{{asset('new/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('new/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('new/js/select2.min.js')}}"></script>
    <script src="{{asset('new/js/script.js')}}"></script>
    </section>
@endsection
