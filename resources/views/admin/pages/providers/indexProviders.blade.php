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

            <div class="page-list">
              <div class="page-title">
                <h4> Providers </h4>
            </div>
            <div class="page-list">
              @include('admin.layouts.alerts.success')
              @include('admin.layouts.alerts.errors')

              <div class="table-responsive">
                <form action="{{route('providerSave')}}" method="post" >
                  @csrf
                  <div class="row">
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <div class="controls">
                        <label>cost1</label>
                        <input type="text"  class="form-control" placeholder="cost1" value="{{$provider->cost_1}}" name="cost_1">
                        @if ($errors->has('cost1'))
                          <span class="text-danger">{{ $errors->first('cost1') }}</span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="controls">
                        <label>cost2</label>
                        <input type="text"  class="form-control" placeholder="cost2" value="{{$provider->cost_2}}" name="cost_2">
                        @if ($errors->has('cost2'))
                          <span class="text-danger">{{ $errors->first('cost2') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                <div class="col-12 col-sm-6">

                  <div class="form-group">
                    <div class="controls">
                      <label>cost3</label>
                      <input type="text"  class="form-control" placeholder="cost3"  value="{{$provider->cost_3}}" name="cost_3">
                      @if ($errors->has('cost3'))
                        <span class="text-danger">{{ $errors->first('cost3') }}</span>
                      @endif
                    </div>
                  </div>


                </div>

                </div>
                  <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Save
                      changes</button>
                    <button type="reset" class="btn btn-light">Cancel</button>
                  </div>

                </form>
              </div>
            </div>
        </div>
    </div>
    <!-- Add and edit modal -->


{{--    <script src="{{asset('new/js/jquery-3.2.1.js')}}"></script>--}}
    <script src="{{asset('new/js/propper.min.js')}}"></script>
    <script src="{{asset('new/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('new/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('new/js/select2.min.js')}}"></script>
    <script src="{{asset('new/js/script.js')}}"></script>
        </div></div></div></section>
  @endsection
