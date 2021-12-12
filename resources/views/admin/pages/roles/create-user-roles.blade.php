@extends('admin.layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Form Validation')
{{-- page-styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/file-uploaders/dropzone.css') }}">
@endsection
@section('vendor-styles')

<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/ui/prism.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/file-uploaders/dropzone.min.css')}}">

@endsection

@section('content')

<!-- Input Validation start -->
<section class="input-validation">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Add Roles</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form class="form-horizontal" method="post" action="{{ route('roles.store') }}">

              @csrf

              <div class="row">

                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label>User Name</label>

                    <select class="form-control" name="user_id" id="sql_coun">
                      @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  @error('user_id')
                  <div class="alert alert-danger">

                    <p>{{ $message }}</p>

                  </div>


                  @enderror


                </div>

                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label>Role Name</label>

                    <select class="form-control" name="role" id="sql_coun">
                      @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  @error('role')
                  <div class="alert alert-danger">

                    <p>{{ $message }}</p>

                  </div>


                  @enderror


                </div>
                <div class="col-12">
                  <div class="table-responsive">
                    <table class="table mt-1">
                      <thead>
                        <tr>
                          <th>Module Permission</th>
                          <th>View</th>
                          <th>modification</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Users</td>
                          <td>
                            <div class="checkbox"><input type="checkbox" name="permissions[view_user]"
                                id="users-checkbox1" class="checkbox-input">
                              <label for="users-checkbox1"></label>
                            </div>
                          </td>

                          <td>
                            <div class="checkbox"><input type="checkbox" name="permissions[modify_user]"
                                id="users-checkbox2" class="checkbox-input"><label for="users-checkbox2"></label>
                            </div>
                          </td>

                        </tr>
                        <tr>
                          <td>Category</td>
                          <td>
                            <div class="checkbox"><input type="checkbox" name="permissions[view_category]"
                                id="users-checkbox3" class="checkbox-input">
                              <label for="users-checkbox3"></label>
                            </div>
                          </td>

                          <td>
                            <div class="checkbox"><input type="checkbox" name="permissions[modify_category]"
                                id="users-checkbox4" class="checkbox-input">
                              <label for="users-checkbox4"></label>
                            </div>
                          </td>

                        </tr>
                        <tr>
                          <td>item</td>
                          <td>
                            <div class="checkbox"><input type="checkbox" name="permissions[view_item]"
                                id="users-checkbox5" class="checkbox-input">
                              <label for="users-checkbox5"></label>
                            </div>
                          </td>

                          <td>
                            <div class="checkbox"><input type="checkbox" name="permissions[modify_item]"
                                id="users-checkbox6" class="checkbox-input">
                              <label for="users-checkbox6"></label>
                            </div>
                          </td>

                        </tr>
                        <tr>
                          <td>order</td>
                          <td>
                            <div class="checkbox"><input type="checkbox" name="permissions[view_order]"
                                id="users-checkbox7" class="checkbox-input">
                              <label for="users-checkbox7"></label>
                            </div>
                          </td>

                          <td>
                            <div class="checkbox"><input type="checkbox" name="permissions[modify_order]"
                                id="users-checkbox8" class="checkbox-input">
                              <label for="users-checkbox8"></label>
                            </div>
                          </td>

                        </tr>
                        <tr>
                          <td> Onboarding  </td>
                          <td>
                            <div class="checkbox"><input type="checkbox" name="permissions[view_onboardLog]"
                                                         id="users-checkbox13" class="checkbox-input">
                              <label for="users-checkbox13"></label>
                            </div>
                          </td>

                          <td>
                            <div class="checkbox"><input type="checkbox" name="permissions[modify_onboardLog]"
                                                         id="users-checkbox14" class="checkbox-input">
                              <label for="users-checkbox14"></label>
                            </div>
                          </td>

                        </tr>
                        <tr>
                          <td> Area and City  </td>
                          <td>
                            <div class="checkbox"><input type="checkbox" name="permissions[view_city]"
                                                         id="users-checkbox15" class="checkbox-input">
                              <label for="users-checkbox15"></label>
                            </div>
                          </td>

                          <td>
                            <div class="checkbox"><input type="checkbox" name="permissions[modify_city]"
                                                         id="users-checkbox16" class="checkbox-input">
                              <label for="users-checkbox16"></label>
                            </div>
                          </td>

                        </tr>
                        <tr>
                          <td> ---- </td>
                          <td>
                            <div class="checkbox"><input type="checkbox" name="permissions[view_message]"
                                id="users-checkbox9" class="checkbox-input">
                              <label for="users-checkbox9">view message</label>
                            </div>
                          </td>

                          <td>
                            <div class="checkbox"><input type="checkbox" name="permissions[modify_question]"
                                id="users-checkbox10" class="checkbox-input">
                              <label for="users-checkbox10">modify question</label>
                            </div>
                          </td>

                        </tr>
                        <tr>
                          <td> ---- </td>
                          <td>
                            <div class="checkbox"><input type="checkbox" name="permissions[make_role]"
                                id="users-checkbox11" class="checkbox-input">
                              <label for="users-checkbox11">Make Role</label>
                            </div>
                          </td>

                          <td>
                            <div class="checkbox"><input type="checkbox" name="permissions[send_notification]"
                                id="users-checkbox12" class="checkbox-input">
                              <label for="users-checkbox12">Send Notification</label>
                            </div>
                          </td>

                        </tr>
                        <tr>
                          <td> ---- </td>
                          <td>
                            <div class="checkbox"><input type="checkbox" name="permissions[view_question]"
                                id="users-checkbox17" class="checkbox-input">
                              <label for="users-checkbox17">Questions</label>
                            </div>
                          </td>


                        </tr>

                      </tbody>
                    </table>
                  </div>
                </div>

              </div>

              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Input Validation end -->
@endsection
{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{ asset('vendors/js/forms/validation/jqBootstrapValidation.js' )}}"></script>
<script src="{{asset('vendors/js/extensions/dropzone.min.js')}}"></script>
<script src="{{asset('vendors/js/ui/prism.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/polyfill.min.js')}}"></script>

@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{ asset  ('js/scripts/forms/validation/form-validation.js' )}}"></script>
<script src="{{asset('js/scripts/extensions/dropzone.js')}}"></script>


@endsection
