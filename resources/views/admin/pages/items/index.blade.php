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
          <a href="{{route('items.create')}}" class="btn btn-sm btn-success">Add Item</a>
        </div>
        <!-- datatable start -->
        @include('admin.layouts.alerts.success')
        @include('admin.layouts.alerts.errors')
        @if(isset($xError))
          @foreach($xError as $x)
            <div>
              <span class="text-danger"> <li>{{$x}}</li></span>
            </div>
          @endforeach
         @endif
        <div class="table-responsive">
          <table class="table" id="userDatatable">
            <thead>
              <tr>
                <th>id</th>
                <th>image</th>
                <th>name</th>
                <th>quantity</th>
                <th>quantity type</th>
                <th>category</th>
                <th>price</th>
                <th>discount</th>
                <th>{{$provider->cost_1}}</th>
                <th>{{$provider->cost_2}}</th>
                <th>{{$provider->cost_3}}</th>
                <th>price by point</th>
                <th>status</th>
                <th>Is offer</th>
                <th>edit</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                    <td>
                      <img src="{{ \Illuminate\Support\Facades\URL::to('/') }}/images/items/{{$item->image}}"alt="Item" width="100" height="100">
                    </td>
                      <td>{{$item->name}}</td>
                      <td>{{$item->quantity}}</td>
                      <td>{{$item->quantity_type}}</td>
                      <td>{{$item->category->name}}</td>
                      <td>{{$item->price}}</td>
                      <td>{{$item->discount}}</td>
                      <td>{{$item->cost1}}</td>
                      <td>{{$item->cost2}}</td>
                      <td>{{$item->cost3}}</td>
                      <td>{{$item->pricebypoint}}</td>
                      <td>
                          @if($item->status == 1)
                            <span class="badge badge-light-success">Active</span>
                          @elseif($item->status == 0)
                            <span class="badge badge-light-info">InActive</span>
                          @endif
                        </td>
                      <td>
                          @if($item->is_offer == 1)
                            <span class="badge badge-light-success">Active</span>
                          @elseif($item->is_offer == 0)
                            <span class="badge badge-light-info">InActive</span>
                          @endif
                        </td>
                        <td>
                          <a href="{{route('items.edit',$item->id)}}" class="badge badge-primary"><i class="bx bx-edit-alt"></i></a>
                          <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#exampleModal{{$item->id}}"><i class="bx bx-trash-alt"></i></a>
                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Delete Item</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to delete this Item ?
                                </div>
                                <form method="POST" action="{{route('items.destroy',$item->id)}}">
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

 page scripts
@section('page-scripts')
<script src="{{asset('js/scripts/pages/app-users.js')}}"></script>
<script>
  $("#userDatatable").DataTable();
</script>
@endsection
