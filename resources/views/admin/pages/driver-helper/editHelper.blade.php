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
          <h4>Edit helper</h4>
        </div>
        <div class="tab-content">
          <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab" role="tabpanel">
            <!-- users edit account form start -->
            <form action="{{route('update_helpers' , $user->id)}}" method="post" autocomplete="off" enctype="multipart/form-data">
              @csrf
              @method('PATCH')
              <div class="row">
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <div class="controls">
                      <label>Name</label>
                      <input type="text" required class="form-control" value="{{$user->name}}" placeholder="Name" name="name">
                      @error('name')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="controls">
                      <label>E-mail</label>
                      <input type="email" value="{{$user->email}}" required class="form-control" autocomplete="off" placeholder="Email" name="email">
                      @error('email')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="controls">
                      <label>Phone</label>
                      <input type="text" value="{{$user->phone}}" required class="form-control" autocomplete="off" placeholder="phone" name="phone">
                      @error('phone')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="controls">
                      <label>address</label>
                      <input type="text" value="{{$user->address}}" required class="form-control" autocomplete="off" placeholder="address" name="address">
                      @error('address')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="controls">
                      <label>ID Image</label>
                      <input  type="file" name="idImage" class="form-control">
                      <br>
                      <img src="{{ \Illuminate\Support\Facades\URL::to('/') }}/images/drivers/ids/{{ $user->idImage!=null ? $user->idImage : "download1.jpg"}}"alt="helper" width="100" height="100">
                      @error('idImage')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="controls">
                      <label>license Car</label>
                      <input  type="file" name="licenseCar" class="form-control">
                      <br>
                      <img src="{{ \Illuminate\Support\Facades\URL::to('/') }}/images/drivers/licenseCar/{{ $user->licenseCar!=null ? $user->licenseCar : "download1.jpg"}}"alt="helper" width="100" height="100">
                      @error('licenseCar')
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
                      <label>Age</label>
                      <input type="text"  autocomplete="off" class="form-control" placeholder="age" name="age" value="{{$user->age}}">
                      @error('age')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                      <option @if($user->status == 1 )selected @endif value="1">Active</option>
                      <option @if($user->status == 2 )selected @endif value="2">InActive</option>
                      <option @if($user->status == 3 )selected @endif value="3">Banned</option>
                    </select>
                  </div>
{{--                  <div class="form-group">--}}
{{--                    <div class="controls">--}}
{{--                      <label>Is helper</label>--}}
{{--                      <select required class="form-control" name="is_helper">--}}
{{--                        <option value="1">Yes</option>--}}
{{--                        <option value="0">No</option>--}}
{{--                      </select>--}}
{{--                      @error('is_helper')--}}
{{--                      <span class="text-danger">{{$message}}</span>--}}
{{--                      @enderror--}}
{{--                    </div>--}}
{{--                  </div>--}}
                  <div class="form-group">
                    <div class="controls">
                      <label> Is Driver </label>
                      <div class="form-group">
                        <input type="checkbox" name="is_driver" id="switch15" switch="bool" @if($user->is_driver == 1 )checked @endif  value="{{$user->is_driver ==1?1:0}}" />
                        <label for="switch15" data-on-label="Active" data-off-label="DisActive"></label>
                      </div>
                      @error('is_driver')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="controls">
                      <label>Image</label>
                      <input  type="file" name="image" class="form-control">
                      <br>
                      <img src="{{ \Illuminate\Support\Facades\URL::to('/') }}/images/drivers/{{ $user->image!=null ? $user->image : "download.jpg"}}"alt="helper" width="100" height="100">
                      @error('image')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="controls">
                      <label>license</label>
                      <input  type="file" name="license" class="form-control">
                      <br>
                      <img src="{{ \Illuminate\Support\Facades\URL::to('/') }}/images/drivers/license/{{ $user->license!=null ? $user->license : "download.jpg"}}"alt="helper" width="100" height="100">
                      @error('license')
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
