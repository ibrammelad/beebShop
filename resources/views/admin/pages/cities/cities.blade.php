@extends('admin.layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Cities List')
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
              <h3>Cities</h3>
            </div>
            @include('admin.layouts.alerts.success')
            @include('admin.layouts.alerts.errors')
                <div class="action-row">
                    <a href="/admin/cities-form" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    Provinces Name
                                </th>
                                <th>
                                    Area Name
                                </th>
                                <th>
                                    Delivery Cost
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
                        @foreach($cities as $city)
                            <tr>
                                <td>
                                    <span class="td-data">{{$city->name}}</span>
                                </td>
                                <td>
                                    <span class="td-data">{{$city->area->name}}</span>
                                </td>
                                <td>
                                    <span class="td-data">{{$city->cost}}</span>
                                </td>
                              <td>
                                @if($city->status == 1)
                                  <span class="badge badge-light-success">Active</span>
                                @elseif($city->status == 0)
                                  <span class="badge badge-light-info">InActive</span>
                                @endif
                              </td>
                                <td class="td-actions-group">
                                    <div class="actions">
                                        <a href="{{route('edit_city' , $city->id)}}" class="table-action-btn" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                      <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#exampleModal{{$city->id}}"><i class="bx bx-trash-alt"></i></a>
                                      <!-- Modal -->
                                      <div class="modal fade" id="exampleModal{{$city->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Delete City</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              Are you sure you want to delete this City ?
                                            </div>
                                            <form method="POST" action="{{route('delete_city',$city->id)}}">
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

    </div></div>
@endsection
