@extends('admin.layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Datatables')

{{-- vendor style --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
@endsection
{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-users.css')}}">
@endsection
{{-- page-styles --}}

@section('content')




<section id="column-selectors-user-roles">
  <div class="row">
    <div class="col-12">
      <div class="card">
      <div class="card-header d-flex justify-content-between">
          <h4 class="card-title">User Roles</h4>
        @include('admin.layouts.alerts.success')
        @include('admin.layouts.alerts.errors')
          <a href="{{ route('roles.create') }}" class="btn btn-sm btn-success">User Roles</a>
        </div>
        <div class="card-content">
          <div class="card-body card-dashboard">

            <div class="table-responsive">
              <table class="table" id="userDatatable">
                <thead>
                  <tr>
                    <th>Created at</th>
                    <th>User Name</th>
                    <th>Role</th>
                    <th>Action(s)</th>

                  </tr>
                </thead>
                <tbody>
                @isset($users)
                @foreach ( $users as $user )
                  <tr>
                    <td>{{\Carbon\Carbon::parse($user->created_at)->format('Y/m/d')}}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->roles->first()->name}}</td>

                    <td>
{{--                      <a href="{{route('roles.edit',$user)}}" class="badge badge-primary"><i class="bx bx-edit-alt"></i></a>--}}
                      <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#exampleModal{{$user->id}}"><i class="bx bx-trash-alt"></i></a>
                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              Are you sure you want to delete role form this Role ?
                            </div>
                            <form method="POST" action="{{route('roles.destroy',$user->id)}}">
                              @csrf
                              @method('DELETE')
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Confirm</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <!-- End -->
                    </td>
                  </tr>
                  @endforeach
                @endisset





                </tbody>

              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--/ Scroll - horizontal and vertical table -->
@endsection
{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.bootstrap4.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/pages/app-users.js')}}"></script>
<script>
  $("#userDatatable").DataTable();
</script>
@endsection

