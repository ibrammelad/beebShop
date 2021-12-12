@extends('admin.layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Ended Orders List')
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
            @include('admin.layouts.alerts.success')
            @include('admin.layouts.alerts.errors')

            <div class="page-list">
            <div class="page-title">
                <h4>Notification</h4>
            </div>
            <!-- Add and delete form  -->
            <div class="page=form">

                <fieldset class="fieldset">
                    <legend>
                        <h5>Send notification</h5>
                    </legend>
                    <div class="fieldset-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <div class="control-container">
                                    <label class="control-lable">
                                        <span class="title">Notification title</span>
                                        <!-- To hide validate span add class "hide" -->
                                    </label>
                                    <input class="form-control" placeholder="Enter notification title">
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="control-container">
                                    <label class="control-lable">
                                        <span class="title">Send notification to</span>
                                        <!-- To hide validate span add class "hide" -->
                                    </label>
                                    <select class="form-control">
                                        <option selected>select user type</option>
                                        <option >Helpers</option>
                                        <option >Drivers</option>
                                        <option >Drivers & Helpers</option>
                                        <option >Clients</option>
                                        <option >All</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="control-container">
                                    <label class="control-lable">
                                        <span class="title">Notification content</span>
{{--                                        <span class="text-danger validate">Required</span>--}}
                                        <!-- To hide validate span add class "hide" -->
                                    </label>
                                    <textarea class="form-control" placeholder="Enter notification content"></textarea>
                                </div>
                            </div>
                        </div> <!-- Row End -->

                        <div class="action-row">
                            <a class="btn btn-primary">Send</a>
                            <a class="btn btn-light">Clear</a>
                        </div>
                    </div>
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
        </div></div></div></section>
@endsection
