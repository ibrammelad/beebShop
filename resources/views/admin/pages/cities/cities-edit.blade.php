@extends('admin.layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Edit City')
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
                <h4>City Edit</h4>
            </div>
            <!-- Add and delete form  -->
            <div class="page=form">

                <fieldset class="fieldset">
                    <legend>
                        <h5>Add New Cities</h5>
                    </legend>
                  <form method="post" action="{{route('update_city' , $city->id)}}">
                    @csrf
                    @method('PATCH')
                    <div class="fieldset-body">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <div class="control-container">
                                    <label class="control-lable">
                                        <span class="title">Select Area</span>
                                        <!-- To hide validate span add class "hide" -->
                                    </label>
                                    <select class="form-control" name="area_id" id="sql_coun">
                                      @foreach($areas as $area)
                                        <option value="{{$area->id}}" @if($city->area_id == $area->id) selected @endif>{{$area->name}}</option>
                                      @endforeach
                                    </select>
                                  @if ($errors->has('area_id'))
                                    <span class="text-danger">{{ $errors->first('area_id') }}</span>
                                  @endif
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <div class="control-container">
                                    <label class="control-lable">
                                        <span class="title">City Name</span>
                                        <!-- To hide validate span add class "hide" -->
                                    </label>
                                    <input class="form-control" name="name"  value="{{$city->name}}" placeholder="Enter City name">
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
                                    <input class="form-control" name="cost"  value="{{$city->cost}}" placeholder="Enter delivery cost">
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
                              <option  @if($city->status == 1) selected @endif value="1">Active</option>
                              <option  @if($city->status == 0) selected @endif value="0">InActive</option>
                            </select>
                            @if ($errors->has('status'))
                              <span class="text-danger">{{ $errors->first('status') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>

                        <div class="action-row">
                          <input type="submit" value="Save" class="btn btn-primary">
                          <a href="{{route('city_index')}}" class="btn btn-light">Cancel</a>
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
    {{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}
    {{--    <script type="text/javascript">--}}

    {{--    $(document).ready(function () {--}}

    {{--        ///// country change //////--}}
    {{--        $('#sql_coun').change(function () {--}}
    {{--            var id = $(this).val();--}}

    {{--            /////empty cities dropdown--}}
    {{--            $('#sql_city').find('option').not(':first').remove();--}}

    {{--            /// ajax request--}}
    {{--            $.ajax({--}}
    {{--                url: 'getCities/'+id,--}}
    {{--                type: 'get',--}}
    {{--                dataType: 'json',--}}
    {{--                success: function (response) {--}}
    {{--                    var len = 0;--}}
    {{--                    if(response['data']!=null) {--}}
    {{--                        len = response['data'].length;--}}
    {{--                    }--}}

    {{--                    if(len>0)--}}
    {{--                    {--}}
    {{--                        /// read data and create <option>--}}
    {{--                        for (var i=0 ; i<len ;i++)--}}
    {{--                        {--}}
    {{--                            var id = response['data'][i].id;--}}
    {{--                            var name = response['data'][i].name;--}}
    {{--                            var option = "<option value='"+id+"'>"+name+"</option>";--}}
    {{--                            $('#sql_city').append(option);--}}
    {{--                        }--}}
    {{--                    }--}}
    {{--                }--}}
    {{--            });--}}
    {{--        });--}}
    {{--    });--}}

@endsection
