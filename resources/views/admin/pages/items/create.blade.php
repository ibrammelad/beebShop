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

    <div class="card-body">
      <div class="tab-content">
        @include('admin.layouts.alerts.success')
        @include('admin.layouts.alerts.errors')
        <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab" role="tabpanel">
            <!-- users edit account form start -->
            <form action="{{route('items.store')}}" method="POST" autocomplete="off" enctype="multipart/form-data">
                @csrf
                @method('POST')
                @if (count($errors) > 0)
                  <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                <div class="row">
                  <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <div class="controls">
                            <label>Name</label>
                            <input type="text" required class="form-control" placeholder="Name" name="name">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="controls">
                            <label>Price</label>
                            <input type="text" required class="form-control" autocomplete="off" placeholder="Price" name="price">
                            @if ($errors->has('price'))
                                <span class="text-danger">{{ $errors->first('price') }}</span>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="controls">
                            <label>discount</label>
                            <input type="text" required class="form-control" autocomplete="off" placeholder="discount" name="discount">
                            @if ($errors->has('discount'))
                                <span class="text-danger">{{ $errors->first('discount') }}</span>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="controls">
                          <label>quantity</label>
                          <input type="text" required class="form-control" placeholder="quantity" name="quantity">
                          @if ($errors->has('quantity'))
                            <span class="text-danger">{{ $errors->first('quantity') }}</span>
                          @endif
                        </div>
                      </div>
                    <div class="form-group">
                      <div class="controls">
                        <label> category </label>
                        <div class="form-group">
                          <select name="category_id" class="select2 form-control">
                            <option value="0">---- select Category ----</option>
                            @foreach($categories as $category)
                              <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        @error('category_id ')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                  </div>
                    <div class="form-group">
                      <div class="controls">
                        <label>Description</label>
                        <input type="text" required class="form-control" placeholder="Description" name="description">
                        @if ($errors->has('description'))
                          <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                      </div>
                    </div>


                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <div class="controls">
                        <label>{{$provider->cost_1}}</label>
                        <input type="text" required class="form-control" placeholder="cost1" name="cost1">
                        @if ($errors->has('cost1'))
                          <span class="text-danger">{{ $errors->first('cost1') }}</span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="controls">
                        <label>{{$provider->cost_2}}</label>
                        <input type="text" required class="form-control" placeholder="cost2" name="cost2">
                        @if ($errors->has('cost2'))
                          <span class="text-danger">{{ $errors->first('cost2') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="controls">
                        <label>{{$provider->cost_3}}</label>
                        <input type="text" required class="form-control" placeholder="cost3" name="cost3">
                        @if ($errors->has('cost3'))
                          <span class="text-danger">{{ $errors->first('cost3') }}</span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="controls">
                          <label>quantity type</label>
                          <select required class="form-control" name="quantity_type">
                            <option value="grams">Grams</option>
                            <option value="kilogram">KiloGrams</option>
                            <option value="liter">Liter</option>
                            <option value="mill liter">MillLiter</option>
                            <option value="dozen">Dozen</option>
                            <option value="beads">beads</option>
                          </select>
                          @if ($errors->has('quantity_type'))
                              <span class="text-danger">{{ $errors->first('quantity_type') }}</span>
                          @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="controls">
                          <label>Status</label>
                          <select required class="form-control" name="status">
                            <option value="1">Active</option>
                            <option value="0">InActive</option>
                          </select>
                          @if ($errors->has('status'))
                              <span class="text-danger">{{ $errors->first('status') }}</span>
                          @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="controls">
                          <label>Is Offer</label>
                          <select required class="form-control" name="is_offer">
                            <option value="1">Active</option>
                            <option value="0">InActive</option>
                          </select>
                          @if ($errors->has('is_offer'))
                              <span class="text-danger">{{ $errors->first('is_offer') }}</span>
                          @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="controls">
                        <label>price by point</label>
                        <input type="text" required class="form-control" placeholder="pricebypoint" name="pricebypoint">
                        @if ($errors->has('pricebypoint'))
                          <span class="text-danger">{{ $errors->first('pricebypoint') }}</span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="controls">
                        <label>Image</label>
                        <input required type="file" name="image" class="form-control">
                        <br>
                        <img id="preview-image" width="200px">
                        @if ($errors->has('image'))
                          <span class="text-danger">{{ $errors->first('image') }}</span>
                        @endif
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

        <form action="{{route('importExcel')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">

                  <div class="row">
                    <div class="col-6">
                      <label> Excel File </label>
                      <div class="fallback">
                        <input type="file" name="file" class="dropzone">
                      </div>
                    </div>

                  </div>

                  <div class="form-group mt-4">
                    <div>
                      <button type="submit" class="btn btn-success waves-effect waves-light">
                        حفظ
                      </button>
                    </div>
                  </div>


                </div>
              </div>
            </div> <!-- end col -->
          </div> <!-- end row -->
        </form>
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
