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
                <h4>Create Onboarding Content</h4>
            </div>
            <!-- Add and delete form  -->
            <div class="page=form">
                <fieldset class="fieldset">
                    <legend>
                        <h5>Add New content</h5>
                    </legend>
                  <form action="{{route('store_onboard')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="fieldset-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <div class="control-container">
                                    <label class="control-lable">
                                        <span class="title">Upload Image</span>
                                        <!-- To hide validate span add class "hide" -->
                                    </label>
                                    <input type="file" name="image" class="form-control mt-2">
                                  @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>
                            </div>
                            <div class="col-12"></div>
                            <div class="col-md-6 form-group">
                                <div class="control-container">
                                    <label class="control-lable">
                                        <span class="title">Select place</span>
                                        <!-- To hide validate span add class "hide" -->
                                    </label>
                                    <select class="form-control" name="place">
                                        <option selected>select place</option>
                                        <option value="page1">page1</option>
                                        <option value="page2">page2</option>
                                        <option value="page3">page3</option>
                                        <option value="page4">page4</option>
                                        <option value="itemAdd">itemAdd</option>
                                        <option value="orderCompleted">orderCompleted</option>
                                    </select>
                                  @error('place')
                                  <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="control-container">
                                    <label class="control-lable">
                                        <span class="title">Title</span>
                                        <!-- To hide validate span add class "hide" -->
                                    </label>
                                    <input class="form-control" name="title" placeholder="Enter title">
                                  @error('title')
                                  <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="control-container">
                                    <label class="control-lable">
                                        <span class="title">Description</span>
                                        <!-- To hide validate span add class "hide" -->
                                    </label>
                                    <input class="form-control" name="description" placeholder="Enter description">
                                    @error('description')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div> <!-- Row End -->

                        <div class="action-row">
                          <input type="submit" value="Save"  class="btn btn-primary">
                            <a href="/admin/onboarding" class="btn btn-light">Cancel</a>
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

{{--  </section>--}}
@endsection
