@extends('admin.layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Areas List')
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
  {{--  <section class="users-list-wrapper">--}}
  <div class="users-list-table">
    <div class="card">
      <div class="card-body">
        <div class="col-12 d-flex align-items-center justify-content-end pb-1">

          <div class="page-list">
            <div class="page-title">
              <h3>Areas</h3>
            </div>
            @include('admin.layouts.alerts.success')
            @include('admin.layouts.alerts.errors')
                <div class="action-row">
                    <a href="/admin/areas-form" class="btn btn-primary" ><i class="fas fa-plus"></i> Add New</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    Area Name
                                </th>
                              <th>
                                    Status
                                </th>
                                <th class="th-actions">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($areas as $area)
                            <tr>
                                <td>
                                    <span class="td-data">{{$area->name}}</span>
                                </td>
                              <td>
                                @if($area->status == 1)
                                  <span class="badge badge-light-success">Active</span>
                                @elseif($area->status == 0)
                                  <span class="badge badge-light-info">InActive</span>
                                @endif
                              </td>
                                <td class="td-actions-group">
                                    <div class="actions">
                                        <a href="/admin/areas-edit/{{$area->id}}" class="table-action-btn" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                      <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#exampleModal{{$area->id}}"><i class="bx bx-trash-alt"></i></a>
                                      <!-- Modal -->
                                      <div class="modal fade" id="exampleModal{{$area->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Delete Area</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              Are you sure you want to delete this Area ?
                                            </div>
                                            <form method="POST" action="{{route('destroy_area',$area->id)}}">
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
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
{{--    <script src="{{asset('new/js/jquery-3.2.1.js')}}"></script>--}}
    <script src="{{asset('new/js/propper.min.js')}}"></script>
    <script src="{{asset('new/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('new/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('new/js/select2.min.js')}}"></script>
    <script src="{{asset('new/js/script.js')}}"></script>
    </div></div>@endsection
