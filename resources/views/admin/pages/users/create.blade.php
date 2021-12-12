@extends('admin.layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Users Create')
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
      @include('admin.layouts.alerts.success')
      @include('admin.layouts.alerts.errors')
      <div class="card-body">
        <div class="page-title">
          <h4>Create User/Admin</h4>
        </div>
        <div class="tab-content">
          <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab" role="tabpanel">
            <!-- users edit account form start -->
            <form action="{{route('users.store')}}" method="POST" autocomplete="off" enctype="multipart/form-data">
              @csrf
              @method('POST')
              <div class="row">
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <div class="controls">
                      <label>Name</label>
                      <input type="text" required class="form-control" placeholder="Name" name="name">
                      @error('name')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="controls">
                      <label>E-mail</label>
                      <input type="email" required class="form-control" autocomplete="off" placeholder="Email" name="email">
                      @error('email')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="controls">
                      <label>Phone</label>
                      <input type="text" required class="form-control" autocomplete="off" placeholder="phone" name="phone">
                      @error('phone')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Role Name</label>

                    <select class="form-control" name="roles" id="sql_coun">
                      <option value="">customer</option>
                    @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                      @endforeach
                    </select>
                  </div>


                </div>
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <div class="controls">
                      <label>Password</label>
                      <input type="password" required autocomplete="off" class="form-control" placeholder="Password" name="password">
                      @error('password')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="controls">
                      <label>points</label>
                      <input type="text" class="form-control" autocomplete="off" placeholder="points" name="points">
                      @error('points')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                      <option value="1">Active</option>
                      <option value="2">InActive</option>
                      <option value="3">Banned</option>
                    </select>
                  </div>
{{--                  <div class="form-group">--}}
{{--                    <div class="controls">--}}
{{--                      <label>Is helper</label>--}}
{{--                      <select required class="form-control" name="is_helper">--}}
{{--                        <option value="1">Yes</option>--}}
{{--                        <option value="0">No</option>--}}
{{--                      </select>--}}
{{--                                                @error('is_helper')--}}
{{--                                                <span class="text-danger">{{$message}}</span>--}}
{{--                                                @enderror--}}
{{--                    </div>--}}
{{--                  </div>--}}
                  <div class="form-group">
                    <div class="controls">
                      <label>Image</label>
                      <input  type="file" name="image" class="form-control">
                      <br>
                      <img id="preview-image" width="200px">
                      @error('image')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
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
