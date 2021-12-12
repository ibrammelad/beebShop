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
{{--  <section class="users-list-wrapper">--}}
    <div class="users-list-table">
      <div class="card">
        <div class="card-body">
          <div class="col-12 d-flex align-items-center justify-content-end pb-1">


            <div class="page-list">

            <div class="page-title">
                <h4>Onboarding Content</h4>
            </div>
              @include('admin.layouts.alerts.success')
              @include('admin.layouts.alerts.errors')
            <div class="page-list">
                <div class="action-row">
                    <a href="/admin/onboarding-form" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    Image
                                </th>
                                <th>
                                    Place
                                </th>
                                <th>
                                    Title
                                </th>
                                <th>
                                    Description
                                </th>
                                <th class="th-actions">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($onboardings as $onboarding)
                            <tr>
                                <td>
                                  <img src="{{ \Illuminate\Support\Facades\URL::to('/') }}/images/onboard/{{ $onboarding->image!=null ? $onboarding->image : "download.jpg"}}"alt="onboarding" width="100" height="100">
                                </td>
                                <td>
                                    <span class="td-data">{{$onboarding->place}}</span>
                                </td>
                                <td>
                                    <span class="td-data">{{$onboarding->title}}</span>
                                </td>
                                <td>
                                    <span class="td-data">{{$onboarding->description}}</span>
                                </td>
                                <td class="td-actions-group">
                                    <div class="actions">
                                        <a href="{{route('edit_onboard' ,$onboarding->id)}}" class="table-action-btn" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                      <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#exampleModal{{$onboarding->id}}"><i class="bx bx-trash-alt"></i></a>
                                      <!-- Modal -->
                                      <div class="modal fade" id="exampleModal{{$onboarding->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Delete Onboarding</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              Are you sure you want to delete this Onboarding ?
                                            </div>
                                            <form method="POST" action="{{route('delete_onboard',$onboarding->id)}}">
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

          </div></div></div>
  @endsection
