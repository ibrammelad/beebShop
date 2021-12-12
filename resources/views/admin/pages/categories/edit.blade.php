@extends('admin.layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Users Edit')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/pickers/pickadate/pickadate.css')}}">
@endsection

{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-users.css')}}">
@endsection

@section('content')
<!-- users edit start -->
<section class="users-edit mt-5">
  <div class="card">
    <div class="card-body">
      <div class="tab-content">
        <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab" role="tabpanel">
        @include('admin.layouts.alerts.success')
        @include('admin.layouts.alerts.errors')
          <!-- users edit account form start -->
            <form action="{{route('categories.update',$category)}}" method="POST" autocomplete="off" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <div class="controls">
                            <label>Name</label>
                            <input type="text" value="{{$category->name}}" required class="form-control" placeholder="Name" name="name">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                      </div>
{{--                      <div class="form-group">--}}
{{--                        <div class="controls">--}}
{{--                            <label>Sort</label>--}}
{{--                            <input type="number" value="{{$category->sort}}" required class="form-control" autocomplete="off" placeholder="Sort" name="sort">--}}
{{--                            @if ($errors->has('sort'))--}}
{{--                                <span class="text-danger">{{ $errors->first('sort') }}</span>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                      </div>--}}
                  </div>
                  <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option @if($category->status == 1) selected @endif value="1">Active</option>
                            <option @if($category->status == 0) selected @endif value="0">InActive</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <div class="controls">
                          <label>Image</label>
                          <input type="file" name="image" class="form-control">
                          <br>
                          <img src="{{ \Illuminate\Support\Facades\URL::to('/') }}/images/categories/{{ $category->image}}" id="preview-image" width="200px">
                          @if ($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                          @endif
                        </div>
                      </div>
                  </div>
                  <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                      <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Save
                        changes</button>
                      <button type="reset" class="btn btn-light">Cancel</button>
                  </div>
                </div>
            </form>
            <!-- users edit account form ends -->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- users edit ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.date.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/pages/app-users.js')}}"></script>
<script src="{{asset('js/scripts/navs/navs.js')}}"></script>
@endsection
