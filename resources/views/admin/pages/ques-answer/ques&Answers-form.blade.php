@extends('admin.layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Create Question')
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
  <!-- users edit start -->
  <section class="users-edit mt-5">
    <div class="card">
      @include('admin.layouts.alerts.success')
      @include('admin.layouts.alerts.errors')
      <div class="card-body">
        <div class="page-title">
          <h4>Create Question</h4>
        </div>
        <div class="tab-content">
          <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab" role="tabpanel">
                  <form action="{{route('question_store')}}" method="post">
                    @csrf
                    <div class="fieldset-body">
                        <div class="row">
                            <div class="col-md-9 form-group">
                                <div class="control-container">
                                    <label class="control-lable">
                                        <span class="title">Question</span>
                                        <!-- To hide validate span add class "hide" -->
                                    </label>
                                    <input class="form-control"  name="question" placeholder="Enter Question">
                                  @if ($errors->has('question'))
                                    <span class="text-danger">{{ $errors->first('question') }}</span>
                                  @endif
                                </div>
                            </div><div class="col-md-3 form-group">
                                <div class="control-container">
                                    <label class="control-lable">
                                        <span class="title">Question points</span>
                                        <!-- To hide validate span add class "hide" -->
                                    </label>
                                    <input class="form-control"  name="points" placeholder="Enter Question points">
                                  @if ($errors->has('points'))
                                    <span class="text-danger">{{ $errors->first('points') }}</span>
                                  @endif
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <h5>Answers</h5>
                            </div>

                            <div class="col-md-12 form-group">
                                <ul class="list-unstyled">
                                    <li class="row form-group">
                                        <div class="col-md-9 form-group">
                                            <div class="control-container">
                                                <label class="control-lable">
                                                    <span class="title">Answer 1</span>
                                                    <!-- To hide validate span add class "hide" -->
                                                </label>
                                                <input class="form-control" name="answer1" placeholder="Enter Question">
                                              @if ($errors->has('answer1'))
                                                <span class="text-danger">{{ $errors->first('answer1') }}</span>
                                              @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="opt1" class="radio">
                                                <input type="radio" name="rdo1" id="opt1" class="hidden" />
                                                <span class="label"></span>Correct Answer
                                            </label>
                                        </div>
                                    </li>
                                    <li class="row form-group">
                                        <div class="col-md-9 form-group">
                                            <div class="control-container">
                                                <label class="control-lable">
                                                    <span class="title">Answer 2</span>
                                                    <!-- To hide validate span add class "hide" -->
                                                </label>
                                                <input class="form-control"  name="answer2" placeholder="Enter Question">

                                              @if ($errors->has('answer2'))
                                                <span class="text-danger">{{ $errors->first('answer2') }}</span>
                                              @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="opt2" class="radio">
                                                <input type="radio" name="rdo2" id="opt2" class="hidden" />
                                                <span class="label"></span>Correct Answer
                                            </label>
                                        </div>
                                    </li>
                                    <li class="row form-group">
                                        <div class="col-md-9 form-group">
                                            <div class="control-container">
                                                <label class="control-lable">
                                                    <span class="title">Answer 3</span>
                                                    <!-- To hide validate span add class "hide" -->
                                                </label>
                                                <input class="form-control" name="answer3" placeholder="Enter Question">

                                              @if ($errors->has('answer3'))
                                                <span class="text-danger">{{ $errors->first('answer3') }}</span>
                                              @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="opt3" class="radio">
                                                <input type="radio" name="rdo3" id="opt3" class="hidden" />
                                                <span class="label"></span>Correct Answer
                                            </label>
                                        </div>
                                    </li>
                                    <li class="row form-group">
                                        <div class="col-md-9 form-group">
                                            <div class="control-container">
                                                <label class="control-lable">
                                                    <span class="title">Answer 4</span>
                                                    <!-- To hide validate span add class "hide" -->
                                                </label>
                                                <input class="form-control"  name="answer4" placeholder="Enter Question">

                                              @if ($errors->has('answer4'))
                                                <span class="text-danger">{{ $errors->first('answer4') }}</span>
                                              @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="opt4" class="radio">
                                                <input type="radio" name="rdo4" id="opt4" class="hidden" />
                                                <span class="label"></span>Correct Answer
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div> <!-- Row End -->

                        <div class="action-row">
                            <input type="submit"  class="btn btn-primary" value="Save"/>
                            <a href="{{route('ques_index')}}" class="btn btn-light">Cancel</a>
                        </div>
                    </div>
                  </form>

{{--                </fieldset>--}}
            </div>
        </div>
    </div>
{{--    <script src="{{asset('new/js/jquery-3.2.1.js')}}"></script>--}}
    <script src="{{asset('new/js/propper.min.js')}}"></script>
    <script src="{{asset('new/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('new/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('new/js/select2.min.js')}}"></script>
    <script src="{{asset('new/js/script.js')}}"></script>
    </div></section>
  @endsection
