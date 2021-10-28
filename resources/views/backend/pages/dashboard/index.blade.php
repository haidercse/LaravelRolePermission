@extends('backend.layouts.master')

@section('title')
    Dashboard-page
@endsection

@section('admin-content')
<!-- main content area start -->
<div class="main-content">





    <div class="main-content-inner">
        <!-- sales report area start -->
        <div class="sales-report-area mt-5 mb-5">
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
        </div>
        
        <!-- row area start-->
    </div>
</div>
<!-- main content area end -->
@endsection

