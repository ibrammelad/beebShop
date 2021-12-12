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
      @include('admin.layouts.alerts.success')
      @include('admin.layouts.alerts.errors')
      <div class="card-body">
        <div class="page-title">
          <h4>Create User/Admin</h4>
        </div>
        <div class="tab-content">
          <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab" role="tabpanel">
            <!-- users edit account form start -->
            <form action="{{route('users.update',$user)}}" method="POST" autocomplete="off" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="row">
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <div class="controls">
                      <label>Name</label>
                      <input type="text"  class="form-control" placeholder="Name" value="{{$user->name}}" name="name">
                      @error('name')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="controls">
                      <label>E-mail</label>
                      <input type="email" value="{{$user->email}}"  class="form-control" autocomplete="off" placeholder="Email" name="email">
                      @error('email')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="controls">
                      <label>Phone</label>
                      <input type="text" value="{{$user->phone}}" class="form-control" autocomplete="off" placeholder="phone" name="phone">
                      @error('phone')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="controls">
                      <label> Roles </label>
                      <div class="form-group">
                        <select name="roles" class="select2 form-control">
                          @if($user->roles->count() > 0)
                            <option value=" {{$user->roles->first()->id}}">{{$user->roles->first()->name}}</option>
                          @endif
                            <option value="">customer</option>
                          @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      @error('roles')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <div class="controls">
                      <label>Password</label>
                      <input type="password"  autocomplete="off" class="form-control" placeholder="Password" name="password">
                      @error('password')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="controls">
                      <label>points</label>
                      <input type="text" value="{{$user->points}}" class="form-control" autocomplete="off" placeholder="points" name="points">
                      @error('points')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                      <option @if($user->status == 1) selected @endif value="1">Active</option>
                      <option @if($user->status == 2) selected @endif value="2">InActive</option>
                      <option @if($user->status == 3) selected @endif value="3">Banned</option>
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
                      <input type="file" name="image" class="form-control">
                      <br>
                      <img src="{{ \Illuminate\Support\Facades\URL::to('/') }}/images/users/{{$user->image}}" id="preview-image" width="200px">
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
