@extends('backend.layouts.master')

@section('title')
    Dashboard-page
@endsection

@section('admin-content')
<!-- main content area start -->
<div class="main-content">





    <div class="main-content-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card mt-5">
                        <div class="card-body">
                             <div class="text-center">
                                 <img src="{{ asset('images/user/'.Auth::user()->image) }}" alt="{{ Auth::user()->name }}" style="  border-radius: 50%; height:80px; width:82px">
                                 <p><strong>Name: </strong> {{ Auth::user()->name }}</p>
                                 <p><strong>Join Date: </strong>{{ Auth::user()->created_at->format('d/m/Y')}}</p>
                             </div>
                             <hr>
                             <p><strong>Email : </strong>{{ Auth::user()->email }}</p>
                             <hr>
                             <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum voluptatibus vitae ad veritatis? Natus, rerum dignissimos! Nulla harum porro natus. Quis numquam nihil esse, rerum id rem corporis natus maiores, veritatis ipsum eos consequatur quia et laudantium officiis aspernatur incidunt quam? Quibusdam, omnis. Quos, non!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- sales report area start -->
        {{-- <div class="sales-report-area mt-5 mb-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-report mb-xs-30">
                       <a href="{{ route('roles.index') }}">
                        <div class="s-report-inner pr--20 pt--30 mb-3">
                            <div class="icon"><i class="fas fa-user-tag"></i></div>
                            <div class="s-report-title d-flex justify-content-between">
                                <h4 class="header-title mb-0">Roles</h4>
                                <p>{{ $total_roles }}</p>
                            </div>

                        </div></a>
                        <canvas id="coin_sales1" height="100"></canvas>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-report mb-xs-30">
                        <a href="{{ route('users.index') }}">
                            <div class="s-report-inner pr--20 pt--30 mb-3">
                                <div class="icon"><i class="fas fa-user"></i></div>
                                <div class="s-report-title d-flex justify-content-between">
                                    <h4 class="header-title mb-0">Users (Who has role)</h4>
                                    <p>{{ $total_users }}</p>
                                </div>

                            </div></a>
                        <canvas id="coin_sales2" height="100"></canvas>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-report">
                        <div class="s-report-inner pr--20 pt--30 mb-3">
                            <div class="icon"><i class="fa fa-eur"></i></div>
                            <div class="s-report-title d-flex justify-content-between">
                                <h4 class="header-title mb-0">Permissions</h4>
                                <p>{{ $total_permissions }}</p>
                            </div>

                        </div>
                        <canvas id="coin_sales3" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- row area start-->
    </div>
</div>
<!-- main content area end -->
@endsection

