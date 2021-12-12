@extends('admin.layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Ended Orders List')
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
  <section class="users-list-wrapper">
    <div class="users-list-table">
      <div class="card">
        <div class="card-body">
          <div class="col-12 d-flex align-items-center justify-content-end pb-1">

            <div class="page-list">
              <div class="page-title">
                <h4>Messages</h4>
            </div>
            <div class="page-list">
              @include('admin.layouts.alerts.success')
              @include('admin.layouts.alerts.errors')

              <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    Users
                                </th>
                                <th>
                                    Messages
                                </th>
                                <th class="th-actions">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($messages as $message)
                            <tr>
                                <td>
                                    <span class="td-data">{{$message->user->name}}</span>
                                </td>
                                <td>
                                    <span class="td-data">{{$message->body}}</span>
                                </td>
                                <td class="td-actions-group">
                                    <div class="actions">
{{--                                        <a class="table-action-btn" title="View"  data-toggle="modal" data-target="#exampleModalCenter">--}}
{{--                                            <i class="fas fa-eye"></i>--}}
{{--                                        </a>--}}

                                      <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#exampleModal{{$message->id}}"><i class="bx bx-trash-alt"></i></a>
                                      <!-- Modal -->
                                      <div class="modal fade" id="exampleModal{{$message->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Delete Message</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              Are you sure you want to delete this Message ?
                                            </div>
                                            <form method="POST" action="{{route('delete_message',$message->id)}}">
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
                  {{$messages->links()}}
                </div>
            </div>
        </div>
    </div>
    <!-- Add and edit modal -->


{{--    <script src="{{asset('new/js/jquery-3.2.1.js')}}"></script>--}}
    <script src="{{asset('new/js/propper.min.js')}}"></script>
    <script src="{{asset('new/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('new/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('new/js/select2.min.js')}}"></script>
    <script src="{{asset('new/js/script.js')}}"></script>
        </div></div></div></section>
  @endsection
