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
          <a href="{{route('wizards.create')}}" class="btn btn-sm btn-success">Add Wizard</a>
        </div>
        <!-- datatable start -->
        <div class="table-responsive">
          <table class="table" id="userDatatable">
            <thead>
              <tr>
                <th>id</th>
                <th>image</th>
                <th>name</th>
                <th>edit</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($wizards as $wizard)
                    <tr>
                        <td>{{$wizard->id}}</td>
                        <td><img src="{{$wizard->getMedia('wizards')[0]->getUrl()}}" width="100"></td>
                        <td>{{$wizard->name}}</td>
                        <td>
                          <a href="{{route('wizards.edit',$wizard)}}" class="badge badge-primary"><i class="bx bx-edit-alt"></i></a>
                          <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#exampleModal{{$wizard->id}}"><i class="bx bx-trash-alt"></i></a>
                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal{{$wizard->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to delete this user ?
                                </div>
                                <form method="POST" action="{{route('wizards.destroy',$wizard)}}">
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
