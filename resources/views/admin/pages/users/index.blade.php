@extends('admin.layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Users List')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
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
          <a href="{{route('users.create')}}" class="btn btn-sm btn-success">Add User</a>
        </div>
        <!-- datatable start -->
        @include('admin.layouts.alerts.success')
        @include('admin.layouts.alerts.errors')
        <div class="table-responsive">
          <table class="table" id="userDatatable">
            <thead>
              <tr>
                <th>id</th>
                <th>image</th>
                <th>name</th>
                <th>email</th>
                <th>phone</th>
                <th>points</th>
                <th>status</th>
                <th>edit</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>#100{{$user->id}}</td>
                        <td>
                         <a href="{{ \Illuminate\Support\Facades\URL::to('/') }}/images/users/{{ $user->image!=null ? $user->image : "download.jpg"}}">

                           <img src="{{ \Illuminate\Support\Facades\URL::to('/') }}/images/users/{{ $user->image!=null ? $user->image : "download.jpg"}}"alt="category" width="100" height="100">

                         </a>
                        </td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->points!= null ?$user->points:0 }}</td>
                        <td>
                          @if($user->status == 1)
                            <span class="badge badge-light-success">Active</span>
                          @elseif($user->status == 2)
                            <span class="badge badge-light-info">InActive</span>
                          @elseif($user->status == 3)
                            <span class="badge badge-light-danger">Banned</span>
                          @endif
                        </td>
                        <td>
                          <a href="{{route('users.edit',$user)}}" class="badge badge-primary"><i class="bx bx-edit-alt"></i></a>
                          <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#exampleModal{{$user->id}}"><i class="bx bx-trash-alt"></i></a>
                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Delete Customer</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to delete this Customer ?
                                </div>
                                <form method="POST" action="{{route('users.destroy',$user)}}">
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
            </tbody>
          </table>
          {{ $users->links() }}
        </div>
        <!-- datatable ends -->
      </div>
    </div>
  </div>
</section>
<!-- users list ends -->
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
