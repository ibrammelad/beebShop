@extends('admin.layouts.contentLayoutMaster')

{{-- page Title --}}

@section('title','Welcome BeebShop Admin')

{{-- vendor css --}}

@section('vendor-styles')

<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/charts/apexcharts.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/swiper.min.css')}}">

@endsection

@section('page-styles')

<link rel="stylesheet" type="text/css" href="{{asset('css/pages/dashboard-ecommerce.css')}}">

@endsection



@section('content')

<!-- Dashboard Ecommerce Starts -->

<section id="dashboard-ecommerce">

  <div class="row">

    <!-- Greetings Content Starts -->

     <div class="col-xl-4 col-md-6 col-12 dashboard-greetings">

      <div class="card">

        <div class="card-header">

          <h3 class="greeting-text">Total Number Of Orders : </h3>
        </div>
        <div class="card-body pt-0">
          {{--            <div class="dashboard-content-left">--}}
          <h1 class="text-primary font-large-2 text-bold-500">{{\App\Models\Order::count()}} </h1>
          <a href="{{route('orders_index')}}" class="btn btn-primary glow">View Orders</a>
        </div>

      </div>

    </div>
     <div class="col-xl-4 col-md-6 col-12 dashboard-visit">

       <div class="card">
         <div class="card-header">
           <h4 class="greeting-text ql-color-blue">Latest Order: </h4>
           @if( \App\Models\Order::latest()->first() != null) <a
             href="{{route('order-view',\App\Models\Order::latest()->first()->id)}}"
             class="btn btn-primary glow">Click here</a>
           @else <span>-- No Orders Yet  </span> @endif
         </div>
       </div>
       <div class="col-12">

      <div class="row">

        <div class="col-sm-6 col-12 dashboard-users-success">

          <div class="card text-center">

            <div class="card-body py-1">

              <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">

                <i class="bx bx-briefcase-alt font-medium-5"></i>

              </div>

              <div class="text-muted line-ellipsis">Items</div>

              <h3 class="mb-0">{{\App\Models\Item::count()}}</h3>

            </div>

          </div>

        </div>

        <div class="col-sm-6 col-12 dashboard-users-danger">

          <div class="card text-center">

            <div class="card-body py-1">

              <div class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">

                <i class="bx bx-user font-medium-5"></i>

              </div>

              <div class="text-muted line-ellipsis"> Has Access</div>

              <h3 class="mb-0">{{\App\Models\User::withCount('roles')->has('roles')->count()}}</h3>

            </div>

          </div>

        </div>


      </div>

    </div>
     </div>
     <div class="col-xl-4 col-md-6 col-12 dashboard-visit">
       <div class="card">
         <div class="card-header">
           <h4 class="greeting-text ql-color-blue"> Daily Income : </h4>
           {{\App\Models\FinancialWork::whereDate('created_at',date(\Carbon\Carbon::today()))->sum('amountneed')}}
         </div>
         <div class="card-header">
           <h4 class="greeting-text ql-color-blue"> Weekly Income : </h4>
             {{\App\Models\FinancialWork::whereBetween('created_at',[
        \Carbon\Carbon::parse('last friday')->startOfDay(),
        \Carbon\Carbon::parse('next friday')->endOfDay(),])->sum('amountneed')}}
         </div>
       </div>
       <div class="card">
         <div class="card-header">
           <h4 class="greeting-text ql-color-blue"> Monthly Income : </h4>
           {{\App\Models\FinancialWork::whereMonth('created_at',date('m'))->sum('amountneed')}}
         </div>

         <div class="card-header">
           <h4 class="greeting-text ql-color-blue"> Yearly Income : </h4>
             {{\App\Models\FinancialWork::whereYear('created_at',date('Y'))->sum('amountneed')}}
         </div>
       </div>
    </div>
     </div>
  </div>
  <div class="row">

{{--  <div class="col-md-4 col-12 pl-md-0">--}}

      <div class="col-sm-6 col-12 dashboard-users-success">

        <div class="card text-center">

          <div class="card-body py-1">

            <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">

              <i class="bx bx-user font-medium-5"></i>

            </div>

            <div class="text-muted line-ellipsis">Total Drivers</div>

            <h3 class="mb-0">{{\App\Models\Work::where('is_driver' ,1)->get()->count()}}</h3>

          </div>

          <div class="card-body py-1">

            <div class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">

              <i class="bx bx-user font-medium-5"></i>

            </div>

            <div class="text-muted line-ellipsis"> Customer</div>

            <h3 class="mb-0">{{\App\Models\User::withCount('roles')->has('roles',0)->count()}}</h3>

          </div>


        </div>






      </div>
      <div class="col-sm-6 col-12 dashboard-users-success">

        <div class="card text-center">

          <div class="card-body py-1">

            <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">

              <i class="bx bx-user font-medium-5"></i>

            </div>

            <div class="text-muted line-ellipsis">Total Helpers</div>

            <h3 class="mb-0">{{\App\Models\Work::where('is_helper' ,1)->get()->count()}}</h3>

          </div>

        </div>

      </div>



    {{--    </div>--}}

  </div>
</section>

    <!-- Latest Update Starts -->

   <!-- <div class="col-xl-4 col-md-6 col-12 dashboard-latest-update">

      <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center pb-50">

          <h4 class="card-title">Latest Update</h4>

          <div class="dropdown">

            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButtonSec"

              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

              2020

            </button>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButtonSec">

              <a class="dropdown-item" href="javascript:;">2020</a>

              <a class="dropdown-item" href="javascript:;">2019</a>

              <a class="dropdown-item" href="javascript:;">2018</a>

            </div>

          </div>

        </div>

        <div class="card-body p-0 pb-1">

          <ul class="list-group list-group-flush">

            <li

              class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">

              <div class="list-left d-flex">

                <div class="list-icon mr-1">

                  <div class="avatar bg-rgba-primary m-0">

                    <div class="avatar-content">

                      <i class="bx bxs-zap text-primary font-size-base"></i>

                    </div>

                  </div>

                </div>

                <div class="list-content">

                  <span class="list-title">Total Products</span>

                  <small class="text-muted d-block">2k New Products</small>

                </div>

              </div>

              <span>10k</span>

            </li>

            <li

              class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">

              <div class="list-left d-flex">

                <div class="list-icon mr-1">

                  <div class="avatar bg-rgba-info m-0">

                    <div class="avatar-content">

                      <i class="bx bx-stats text-info font-size-base"></i>

                    </div>

                  </div>

                </div>

                <div class="list-content">

                  <span class="list-title">Total Sales</span>

                  <small class="text-muted d-block">39k New Sales</small>

                </div>

              </div>

              <span>26M</span>

            </li>

            <li

              class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">

              <div class="list-left d-flex">

                <div class="list-icon mr-1">

                  <div class="avatar bg-rgba-danger m-0">

                    <div class="avatar-content">

                      <i class="bx bx-credit-card text-danger font-size-base"></i>

                    </div>

                  </div>

                </div>

                <div class="list-content">

                  <span class="list-title">Total Revenue</span>

                  <small class="text-muted d-block">43k New Revenue</small>

                </div>

              </div>

              <span>15M</span>

            </li>

            <li

              class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">

              <div class="list-left d-flex">

                <div class="list-icon mr-1">

                  <div class="avatar bg-rgba-success m-0">

                    <div class="avatar-content">

                      <i class="bx bx-dollar text-success font-size-base"></i>

                    </div>

                  </div>

                </div>

                <div class="list-content">

                  <span class="list-title">Total Cost</span>

                  <small class="text-muted d-block">Total Expenses</small>

                </div>

              </div>

              <span>2B</span>

            </li>

            <li

              class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">

              <div class="list-left d-flex">

                <div class="list-icon mr-1">

                  <div class="avatar bg-rgba-primary m-0">

                    <div class="avatar-content">

                      <i class="bx bx-user text-primary font-size-base"></i>

                    </div>

                  </div>

                </div>

                <div class="list-content">

                  <span class="list-title">Total Users</span>

                  <small class="text-muted d-block">New Users</small>

                </div>

              </div>

              <span>2k</span>

            </li>

            <li

              class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">

              <div class="list-left d-flex">

                <div class="list-icon mr-1">

                  <div class="avatar bg-rgba-danger m-0">

                    <div class="avatar-content">

                      <i class="bx bx-edit-alt text-danger font-size-base"></i>

                    </div>

                  </div>

                </div>

                <div class="list-content">

                  <span class="list-title">Total Visits</span>

                  <small class="text-muted d-block">New Visits</small>

                </div>

              </div>

              <span>46k</span>

            </li>

          </ul>

        </div>

      </div>

    </div>

    <!-- Earning Swiper Starts -->

  <!--  <div class="col-xl-4 col-md-6 col-12 dashboard-earning-swiper" id="widget-earnings">

      <div class="card">

        <div class="card-header border-bottom d-flex justify-content-between align-items-center">

          <h5 class="card-title"><i class="bx bx-dollar font-medium-5 align-middle"></i> <span

              class="align-middle">Earnings</span></h5>

          <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>

        </div>

        <div class="card-body py-1 px-0">

          <!-- earnings swiper starts -->

      <!--    <div class="widget-earnings-swiper swiper-container p-1">

            <div class="swiper-wrapper">

              <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center" id="repo-design">

                <i class="bx bx-pyramid mr-1 font-weight-normal font-medium-4"></i>

                <div class="swiper-text">

                  <div class="swiper-heading">Repo Design</div>

                  <small class="d-block">Gitlab</small>

                </div>

              </div>

              <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center" id="laravel-temp">

                <i class="bx bx-sitemap mr-50 font-large-1"></i>

                <div class="swiper-text">

                  <div class="swiper-heading">Designer</div>

                  <small class="d-block">Women Clothes</small>

                </div>

              </div>

              <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center" id="admin-theme">

                <i class="bx bx-check-shield mr-50 font-large-1"></i>

                <div class="swiper-text">

                  <div class="swiper-heading">Best Sellers</div>

                  <small class="d-block">Clothing</small>

                </div>

              </div>

              <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center" id="ux-developer">

                <i class="bx bx-devices mr-50 font-large-1"></i>

                <div class="swiper-text">

                  <div class="swiper-heading">Admin Template</div>

                  <small class="d-block">Global Network</small>

                </div>

              </div>

              <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center" id="marketing-guide">

                <i class="bx bx-book-bookmark mr-50 font-large-1"></i>

                <div class="swiper-text">

                  <div class="swiper-heading">Marketing Guide</div>

                  <small class="d-block">Books</small>

                </div>

              </div>

            </div>

          </div>

          <!-- earnings swiper ends -->
<!--
        </div>

        <div class="main-wrapper-content">

          <div class="wrapper-content" data-earnings="repo-design">

            <div class="widget-earnings-scroll table-responsive">

              <table class="table table-borderless widget-earnings-width mb-0">

                <tbody>

                  <tr>

                    <td class="pr-75">

                      <div class="media align-items-center">

                        <a class="media-left mr-50" href="javascript:;">

                          <img src="{{asset('images/portrait/small/avatar-s-10.jpg')}}" alt="avatar"

                            class="rounded-circle" height="30" width="30">

                        </a>

                        <div class="media-body">

                          <h6 class="media-heading mb-0">Jerry Lter</h6>

                          <span class="font-small-2">Designer</span>

                        </div>

                      </div>

                    </td>

                    <td class="px-0 w-25">

                      <div class="progress progress-bar-info progress-sm mb-0">

                        <div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="80"

                          aria-valuemax="100" style="width:33%;"></div>

                      </div>

                    </td>

                    <td class="text-center"><span class="badge badge-light-warning">- $280</span>

                    </td>

                  </tr>

                  <tr>

                    <td class="pr-75">

                      <div class="media align-items-center">

                        <a class="media-left mr-50" href="javascript:;">

                          <img src="{{asset('images/portrait/small/avatar-s-11.jpg')}}" alt="avatar"

                            class="rounded-circle" height="30" width="30">

                        </a>

                        <div class="media-body">

                          <h6 class="media-heading mb-0">Pauly uez</h6>

                          <span class="font-small-2">Devloper</span>

                        </div>

                      </div>

                    </td>

                    <td class="px-0 w-25">

                      <div class="progress progress-bar-success progress-sm mb-0">

                        <div class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="80"

                          aria-valuemax="100" style="width:10%;"></div>

                      </div>

                    </td>

                    <td class="text-center"><span class="badge badge-light-success">+ $853</span>

                    </td>

                  </tr>

                  <tr>

                    <td class="pr-75">

                      <div class="media align-items-center">

                        <a class="media-left mr-50" href="javascript:;">

                          <img src="{{asset('images/portrait/small/avatar-s-11.jpg')}}" alt="avatar"

                            class="rounded-circle" height="30" width="30">

                        </a>

                        <div class="media-body">

                          <h6 class="media-heading mb-0">Lary Masey</h6>

                          <span class="font-small-2">Marketing</span>

                        </div>

                      </div>

                    </td>

                    <td class="px-0 w-25">

                      <div class="progress progress-bar-primary progress-sm mb-0">

                        <div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="80"

                          aria-valuemax="100" style="width:15%;"></div>

                      </div>

                    </td>

                    <td class="text-center"><span class="badge badge-light-primary">+ $125</span>

                    </td>

                  </tr>

                  <tr>

                    <td class="pr-75">

                      <div class="media align-items-center">

                        <a class="media-left mr-50" href="javascript:;">

                          <img src="{{asset('images/portrait/small/avatar-s-12.jpg')}}" alt="avatar"

                            class="rounded-circle" height="30" width="30">

                        </a>

                        <div class="media-body">

                          <h6 class="media-heading mb-0">Lula Taylor</h6>

                          <span class="font-small-2">Degigner</span>

                        </div>

                      </div>

                    </td>

                    <td class="px-0 w-25">

                      <div class="progress progress-bar-danger progress-sm mb-0">

                        <div class="progress-bar" role="progressbar" aria-valuenow="35" aria-valuemin="80"

                          aria-valuemax="100" style="width:35%;"></div>

                      </div>

                    </td>

                    <td class="text-center"><span class="badge badge-light-danger">- $310</span>

                    </td>

                  </tr>

                </tbody>

              </table>

            </div>

          </div>

          <div class="wrapper-content" data-earnings="laravel-temp">

            <div class="widget-earnings-scroll table-responsive">

              <table class="table table-borderless widget-earnings-width mb-0">

                <tbody>

                  <tr>

                    <td class="pr-75">

                      <div class="media align-items-center">

                        <a class="media-left mr-50" href="javascript:;">

                          <img src="{{asset('images/portrait/small/avatar-s-9.jpg')}}" alt="avatar"

                            class="rounded-circle" height="30" width="30">

                        </a>

                        <div class="media-body">

                          <h6 class="media-heading mb-0">Jesus Lter</h6>

                          <span class="font-small-2">Designer</span>

                        </div>

                      </div>

                    </td>

                    <td class="px-0 w-25">

                      <div class="progress progress-bar-info progress-sm mb-0">

                        <div class="progress-bar" role="progressbar" aria-valuenow="28" aria-valuemin="80"

                          aria-valuemax="100" style="width:28%;"></div>

                      </div>

                    </td>

                    <td class="text-center"><span class="badge badge-light-info">- $280</span></td>

                  </tr>

                  <tr>

                    <td class="pr-75">

                      <div class="media align-items-center">

                        <a class="media-left mr-50" href="javascript:;">

                          <img src="{{asset('images/portrait/small/avatar-s-10.jpg')}}" alt="avatar"

                            class="rounded-circle" height="30" width="30">

                        </a>

                        <div class="media-body">

                          <h6 class="media-heading mb-0">Pauly Dez</h6>

                          <span class="font-small-2">Devloper</span>

                        </div>

                      </div>

                    </td>

                    <td class="px-0 w-25">

                      <div class="progress progress-bar-success progress-sm mb-0">

                        <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="80"

                          aria-valuemax="100" style="width:90%;"></div>

                      </div>

                    </td>

                    <td class="text-center"><span class="badge badge-light-success">+ $83</span>

                    </td>

                  </tr>

                  <tr>

                    <td class="pr-75">

                      <div class="media align-items-center">

                        <a class="media-left mr-50" href="javascript:;">

                          <img src="{{asset('images/portrait/small/avatar-s-11.jpg')}}" alt="avatar"

                            class="rounded-circle" height="30" width="30">

                        </a>

                        <div class="media-body">

                          <h6 class="media-heading mb-0">Lary Masey</h6>

                          <span class="font-small-2">Marketing</span>

                        </div>

                      </div>

                    </td>

                    <td class="px-0 w-25">

                      <div class="progress progress-bar-primary progress-sm mb-0">

                        <div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="80"

                          aria-valuemax="100" style="width:15%;"></div>

                      </div>

                    </td>

                    <td class="text-center"><span class="badge badge-light-primary">+ $125</span>

                    </td>

                  </tr>

                  <tr>

                    <td class="pr-75">

                      <div class="media align-items-center">

                        <a class="media-left mr-50" href="javascript:;">

                          <img src="{{asset('images/portrait/small/avatar-s-12.jpg')}}" alt="avatar"

                            class="rounded-circle" height="30" width="30">

                        </a>

                        <div class="media-body">

                          <h6 class="media-heading mb-0">Lula Taylor</h6>

                          <span class="font-small-2">Devloper</span>

                        </div>

                      </div>

                    </td>

                    <td class="px-0 w-25">

                      <div class="progress progress-bar-danger progress-sm mb-0">

                        <div class="progress-bar" role="progressbar" aria-valuenow="35" aria-valuemin="80"

                          aria-valuemax="100" style="width:35%;"></div>

                      </div>

                    </td>

                    <td class="text-center"><span class="badge badge-light-danger">- $310</span>

                    </td>

                  </tr>

                </tbody>

              </table>

            </div>

          </div>

          <div class="wrapper-content" data-earnings="admin-theme">

            <div class="widget-earnings-scroll table-responsive">

              <table class="table table-borderless widget-earnings-width mb-0">

                <tbody>

                  <tr>

                    <td class="pr-75">

                      <div class="media align-items-center">

                        <a class="media-left mr-50" href="javascript:;">

                          <img src="{{asset('images/portrait/small/avatar-s-25.jpg')}}" alt="avatar"

                            class="rounded-circle" height="30" width="30">

                        </a>

                        <div class="media-body">

                          <h6 class="media-heading mb-0">Mera Lter</h6>

                          <span class="font-small-2">Designer</span>

                        </div>

                      </div>

                    </td>

                    <td class="px-0 w-25">

                      <div class="progress progress-bar-info progress-sm mb-0">

                        <div class="progress-bar" role="progressbar" aria-valuenow="52" aria-valuemin="80"

                          aria-valuemax="100" style="width:52%;"></div>

                      </div>

                    </td>

                    <td class="text-center"><span class="badge badge-light-info">- $180</span></td>

                  </tr>

                  <tr>

                    <td class="pr-75">

                      <div class="media align-items-center">

                        <a class="media-left mr-50" href="javascript:;">

                          <img src="{{asset('images/portrait/small/avatar-s-15.jpg')}}" alt="avatar"

                            class="rounded-circle" height="30" width="30">

                        </a>

                        <div class="media-body">

                          <h6 class="media-heading mb-0">Pauly Dez</h6>

                          <span class="font-small-2">Devloper</span>

                        </div>

                      </div>

                    </td>

                    <td class="px-0 w-25">

                      <div class="progress progress-bar-success progress-sm mb-0">

                        <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="80"

                          aria-valuemax="100" style="width:90%;"></div>

                      </div>

                    </td>

                    <td class="text-center"><span class="badge badge-light-success">+ $553</span>

                    </td>

                  </tr>

                  <tr>

                    <td class="pr-75">

                      <div class="media align-items-center">

                        <a class="media-left mr-50" href="javascript:;">

                          <img src="{{asset('images/portrait/small/avatar-s-11.jpg')}}" alt="avatar"

                            class="rounded-circle" height="30" width="30">

                        </a>

                        <div class="media-body">

                          <h6 class="media-heading mb-0">jini mara</h6>

                          <span class="font-small-2">Marketing</span>

                        </div>

                      </div>

                    </td>

                    <td class="px-0 w-25">

                      <div class="progress progress-bar-primary progress-sm mb-0">

                        <div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="80"

                          aria-valuemax="100" style="width:15%;"></div>

                      </div>

                    </td>

                    <td class="text-center"><span class="badge badge-light-primary">+ $125</span>

                    </td>

                  </tr>

                  <tr>

                    <td class="pr-75">

                      <div class="media align-items-center">

                        <a class="media-left mr-50" href="javascript:;">

                          <img src="{{asset('images/portrait/small/avatar-s-12.jpg')}}" alt="avatar"

                            class="rounded-circle" height="30" width="30">

                        </a>

                        <div class="media-body">

                          <h6 class="media-heading mb-0">Lula Taylor</h6>

                          <span class="font-small-2">UX</span>

                        </div>

                      </div>

                    </td>

                    <td class="px-0 w-25">

                      <div class="progress progress-bar-danger progress-sm mb-0">

                        <div class="progress-bar" role="progressbar" aria-valuenow="35" aria-valuemin="80"

                          aria-valuemax="100" style="width:35%;"></div>

                      </div>

                    </td>

                    <td class="text-center"><span class="badge badge-light-danger">- $150</span>

                    </td>

                  </tr>

                </tbody>

              </table>

            </div>

          </div>

          <div class="wrapper-content" data-earnings="ux-developer">

            <div class="widget-earnings-scroll table-responsive">

              <table class="table table-borderless widget-earnings-width mb-0">

                <tbody>

                  <tr>

                    <td class="pr-75">

                      <div class="media align-items-center">

                        <a class="media-left mr-50" href="javascript:;">

                          <img src="{{asset('images/portrait/small/avatar-s-16.jpg')}}" alt="avatar"

                            class="rounded-circle" height="30" width="30">

                        </a>

                        <div class="media-body">

                          <h6 class="media-heading mb-0">Drako Lter</h6>

                          <span class="font-small-2">Designer</span>

                        </div>

                      </div>

                    </td>

                    <td class="px-0 w-25">

                      <div class="progress progress-bar-info progress-sm mb-0">

                        <div class="progress-bar" role="progressbar" aria-valuenow="38" aria-valuemin="80"

                          aria-valuemax="100" style="width:38%;"></div>

                      </div>

                    </td>

                    <td class="text-center"><span class="badge badge-light-danger">- $280</span>

                    </td>

                  </tr>

                  <tr>

                    <td class="pr-75">

                      <div class="media align-items-center">

                        <a class="media-left mr-50" href="javascript:;">

                          <img src="{{asset('images/portrait/small/avatar-s-1.jpg')}}" alt="avatar"

                            class="rounded-circle" height="30" width="30">

                        </a>

                        <div class="media-body">

                          <h6 class="media-heading mb-0">Pauly Dez</h6>

                          <span class="font-small-2">Devloper</span>

                        </div>

                      </div>

                    </td>

                    <td class="px-0 w-25">

                      <div class="progress progress-bar-success progress-sm mb-0">

                        <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="80"

                          aria-valuemax="100" style="width:90%;"></div>

                      </div>

                    </td>

                    <td class="text-center"><span class="badge badge-light-success">+ $853</span>

                    </td>

                  </tr>

                  <tr>

                    <td class="pr-75">

                      <div class="media align-items-center">

                        <a class="media-left mr-50" href="javascript:;">

                          <img src="{{asset('images/portrait/small/avatar-s-11.jpg')}}" alt="avatar"

                            class="rounded-circle" height="30" width="30">

                        </a>

                        <div class="media-body">

                          <h6 class="media-heading mb-0">Lary Masey</h6>

                          <span class="font-small-2">Marketing</span>

                        </div>

                      </div>

                    </td>

                    <td class="px-0 w-25">

                      <div class="progress progress-bar-primary progress-sm mb-0">

                        <div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="80"

                          aria-valuemax="100" style="width:15%;"></div>

                      </div>

                    </td>

                    <td class="text-center"><span class="badge badge-light-primary">+ $125</span>

                    </td>

                  </tr>

                  <tr>

                    <td class="pr-75">

                      <div class="media align-items-center">

                        <a class="media-left mr-50" href="javascript:;">

                          <img src="{{asset('images/portrait/small/avatar-s-2.jpg')}}" alt="avatar"

                            class="rounded-circle" height="30" width="30">

                        </a>

                        <div class="media-body">

                          <h6 class="media-heading mb-0">Lvia Taylor</h6>

                          <span class="font-small-2">Devloper</span>

                        </div>

                      </div>

                    </td>

                    <td class="px-0 w-25">

                      <div class="progress progress-bar-danger progress-sm mb-0">

                        <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="80"

                          aria-valuemax="100" style="width:75%;"></div>

                      </div>

                    </td>

                    <td class="text-center"><span class="badge badge-light-danger">- $360</span>

                    </td>

                  </tr>

                </tbody>

              </table>

            </div>

          </div>

          <div class="wrapper-content" data-earnings="marketing-guide">

            <div class="widget-earnings-scroll table-responsive">

              <table class="table table-borderless widget-earnings-width mb-0">

                <tbody>

                  <tr>

                    <td class="pr-75">

                      <div class="media align-items-center">

                        <a class="media-left mr-50" href="javascript:;">

                          <img src="{{asset('images/portrait/small/avatar-s-19.jpg')}}" alt="avatar"

                            class="rounded-circle" height="30" width="30">

                        </a>

                        <div class="media-body">

                          <h6 class="media-heading mb-0">yono Lter</h6>

                          <span class="font-small-2">Designer</span>

                        </div>

                      </div>

                    </td>

                    <td class="px-0 w-25">

                      <div class="progress progress-bar-info progress-sm mb-0">

                        <div class="progress-bar" role="progressbar" aria-valuenow="28" aria-valuemin="80"

                          aria-valuemax="100" style="width:28%;"></div>

                      </div>

                    </td>

                    <td class="text-center"><span class="badge badge-light-primary">- $270</span>

                    </td>

                  </tr>

                  <tr>

                    <td class="pr-75">

                      <div class="media align-items-center">

                        <a class="media-left mr-50" href="javascript:;">

                          <img src="{{asset('images/portrait/small/avatar-s-11.jpg')}}" alt="avatar"

                            class="rounded-circle" height="30" width="30">

                        </a>

                        <div class="media-body">

                          <h6 class="media-heading mb-0">Pauly Dez</h6>

                          <span class="font-small-2">Devloper</span>

                        </div>

                      </div>

                    </td>

                    <td class="px-0 w-25">

                      <div class="progress progress-bar-success progress-sm mb-0">

                        <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="80"

                          aria-valuemax="100" style="width:90%;"></div>

                      </div>

                    </td>

                    <td class="text-center"><span class="badge badge-light-success">+ $853</span>

                    </td>

                  </tr>

                  <tr>

                    <td class="pr-75">

                      <div class="media align-items-center">

                        <a class="media-left mr-50" href="javascript:;">

                          <img src="{{asset('images/portrait/small/avatar-s-12.jpg')}}" alt="avatar"

                            class="rounded-circle" height="30" width="30">

                        </a>

                        <div class="media-body">

                          <h6 class="media-heading mb-0">Lary Masey</h6>

                          <span class="font-small-2">Marketing</span>

                        </div>

                      </div>

                    </td>

                    <td class="px-0 w-25">

                      <div class="progress progress-bar-primary progress-sm mb-0">

                        <div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="80"

                          aria-valuemax="100" style="width:15%;"></div>

                      </div>

                    </td>

                    <td class="text-center"><span class="badge badge-light-primary">+ $225</span>

                    </td>

                  </tr>

                  <tr>

                    <td class="pr-75">

                      <div class="media align-items-center">

                        <a class="media-left mr-50" href="javascript:;">

                          <img src="{{asset('images/portrait/small/avatar-s-25.jpg')}}" alt="avatar"

                            class="rounded-circle" height="30" width="30">

                        </a>

                        <div class="media-body">

                          <h6 class="media-heading mb-0">Lula Taylor</h6>

                          <span class="font-small-2">Devloper</span>

                        </div>

                      </div>

                    </td>

                    <td class="px-0 w-25">

                      <div class="progress progress-bar-danger progress-sm mb-0">

                        <div class="progress-bar" role="progressbar" aria-valuenow="35" aria-valuemin="80"

                          aria-valuemax="100" style="width:35%;"></div>

                      </div>

                    </td>

                    <td class="text-center"><span class="badge badge-light-danger">- $350</span>

                    </td>

                  </tr>

                </tbody>

              </table>

            </div>

          </div>

        </div>

      </div>

    </div>

    <!-- Marketing Campaigns Starts -->

  <!--  <div class="col-xl-8 col-12 dashboard-marketing-campaign">

      <div class="card marketing-campaigns">

        <div class="card-header d-flex justify-content-between align-items-center pb-1">

          <h4 class="card-title">Marketing campaigns</h4>

          <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>

        </div>

        <div class="card-body pb-0">

          <div class="row mb-1">

            <div class="col-md-9 col-12">

              <div class="d-inline-block">

                <!-- chart-1   -->

       <!--         <div class="d-flex market-statistics-1">

                  <!-- chart-statistics-1 -->

      <!--            <div id="donut-success-chart" class="mx-1"></div>

                  <!-- data -->

      <!--            <div class="statistics-data my-auto">

                    <div class="statistics">

                      <span class="font-medium-2 mr-50 text-bold-600">25,756</span><span

                        class="text-success">(+16.2%)</span>

                    </div>

                    <div class="statistics-date">

                      <i class="bx bx-radio-circle font-small-1 text-success mr-25"></i>

                      <small class="text-muted">May 12, 2020</small>

                    </div>

                  </div>

                </div>

              </div>

              <div class="d-inline-block">

                <!-- chart-2 -->

        <!--        <div class="d-flex mb-75 market-statistics-2">

                  <!-- chart statistics-2 -->

        <!--          <div id="donut-danger-chart" class="mx-1"></div>

                  <!-- data-2 -->

      <!--            <div class="statistics-data my-auto">

                    <div class="statistics">

                      <span class="font-medium-2 mr-50 text-bold-600">5,352</span><span

                        class="text-danger">(-4.9%)</span>

                    </div>

                    <div class="statistics-date">

                      <i class="bx bx-radio-circle font-small-1 text-success mr-25"></i>

                      <small class="text-muted">Jul 26, 2020</small>

                    </div>

                  </div>

                </div>

              </div>

            </div>

            <div class="col-md-3 col-12 text-md-right">

              <button class="btn btn-sm btn-primary glow mt-md-2 mb-1">View Report</button>

            </div>

          </div>

        </div>

        <div class="table-responsive">

          <!-- table start -->

     <!--     <table id="table-marketing-campaigns" class="table table-borderless table-marketing-campaigns mb-0">

            <thead>

              <tr>

                <th>Campaign</th>

                <th>Growth</th>

                <th>Charges</th>

                <th>Status</th>

                <th class="text-center">Action</th>

              </tr>

            </thead>

            <tbody>

              <tr>

                <td class="py-1 line-ellipsis">

                  <img class="rounded-circle mr-1" src="{{asset('images/icon/fs.png')}}" alt="card" height="24"

                    width="24">Fastrack Watches

                </td>

                <td class="py-1">

                  <i class="bx bx-trending-up text-success align-middle mr-50"></i><span>30%</span>

                </td>

                <td class="py-1">$5,536</td>

                <td class="text-success py-1">Active</td>

                <td class="text-center py-1">

                  <div class="dropdown">

                    <span

                      class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"

                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>

                    <div class="dropdown-menu dropdown-menu-right">

                      <a class="dropdown-item" href="javascript:;"><i class="bx bx-edit-alt mr-1"></i> edit</a>

                      <a class="dropdown-item" href="javascript:;"><i class="bx bx-trash mr-1"></i> delete</a>

                    </div>

                  </div>

                </td>

              </tr>

              <tr>

                <td class="py-1 line-ellipsis">

                  <img class="rounded-circle mr-1" src="{{asset('images/icon/puma.png')}}" alt="card" height="24"

                    width="24">Puma Shoes

                </td>

                <td class="py-1">

                  <i class="bx bx-trending-down text-danger align-middle mr-50"></i><span>15.5%</span>

                </td>

                <td class="py-1">$1,569</td>

                <td class="text-success py-1">Active</td>

                <td class="text-center py-1">

                  <div class="dropdown">

                    <span

                      class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"

                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">

                    </span>

                    <div class="dropdown-menu dropdown-menu-right">

                      <a class="dropdown-item" href="javascript:;"><i class="bx bx-edit-alt mr-1"></i> edit</a>

                      <a class="dropdown-item" href="javascript:;"><i class="bx bx-trash mr-1"></i> delete</a>

                    </div>

                  </div>

                </td>

              </tr>

              <tr>

                <td class="py-1 line-ellipsis">

                  <img class="rounded-circle mr-1" src="{{asset('images/icon/nike.png')}}" alt="card" height="24"

                    width="24">Nike Air Jordan

                </td>

                <td class="py-1">

                  <i class="bx bx-trending-up text-success align-middle mr-50"></i><span>70.3%</span>

                </td>

                <td class="py-1">$23,859</td>

                <td class="text-danger py-1">Closed</td>

                <td class="text-center py-1">

                  <div class="dropdown">

                    <span

                      class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"

                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">

                    </span>

                    <div class="dropdown-menu dropdown-menu-right">

                      <a class="dropdown-item" href="javascript:;"><i class="bx bx-edit-alt mr-1"></i> edit</a>

                      <a class="dropdown-item" href="javascript:;"><i class="bx bx-trash mr-1"></i> delete</a>

                    </div>

                  </div>

                </td>

              </tr>

              <tr>

                <td class="py-1 line-ellipsis">

                  <img class="rounded-circle mr-1" src="{{asset('images/icon/one-plus.png')}}" alt="card" height="24"

                    width="24">Oneplus 7 pro

                </td>

                <td class="py-1">

                  <i class="bx bx-trending-up text-success align-middle mr-50"></i><span>10.4%</span>

                </td>

                <td class="py-1">$9,523</td>

                <td class="text-success py-1">Active</td>

                <td class="text-center py-1">

                  <div class="dropdown">

                    <span

                      class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"

                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">

                    </span>

                    <div class="dropdown-menu dropdown-menu-right">

                      <a class="dropdown-item" href="javascript:;"><i class="bx bx-edit-alt mr-1"></i> edit</a>

                      <a class="dropdown-item" href="javascript:;"><i class="bx bx-trash mr-1"></i> delete</a>

                    </div>

                  </div>

                </td>

              </tr>

              <tr>

                <td class="py-1 line-ellipsis">

                  <img class="rounded-circle mr-1" src="{{asset('images/icon/google.png')}}" alt="card" height="24"

                    width="24">Google Pixel 4 xl

                </td>

                <td class="py-1"><i class="bx bx-trending-down text-danger align-middle mr-50"></i><span>-62.38%</span>

                </td>

                <td class="py-1">$12,897</td>

                <td class="text-danger py-1">Closed</td>

                <td class="text-center py-1">

                  <div class="dropup">

                    <span

                      class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"

                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">

                    </span>

                    <div class="dropdown-menu dropdown-menu-right">

                      <a class="dropdown-item" href="javascript:;"><i class="bx bx-edit-alt mr-1"></i> edit</a>

                      <a class="dropdown-item" href="javascript:;"><i class="bx bx-trash mr-1"></i> delete</a>

                    </div>

                  </div>

                </td>

              </tr>

            </tbody>

          </table>

          <!-- table ends -->

   <!--     </div>

      </div>

    </div>

  </div>

</section>


<!-- Dashboard Ecommerce ends -->
{{--<div class="row">--}}
{{--    <div md-12>--}}
{{--        <br>--}}
{{--        <br>--}}
{{--    </div>--}}


{{--</div>--}}
@endsection



@section('vendor-scripts')

<script src="{{asset('vendors/js/charts/apexcharts.min.js')}}"></script>

<script src="{{asset('vendors/js/extensions/swiper.min.js')}}"></script>

@endsection



@section('page-scripts')

<script src="{{asset('js/scripts/pages/dashboard-ecommerce.js')}}"></script>

@endsection

