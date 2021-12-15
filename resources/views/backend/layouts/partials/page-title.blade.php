<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Dashboard</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="index.html">Home</a></li>
                    <li><span>Dashboard</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix" >
            <div class="user-profile pull-right" style="background: rgb(252, 252, 252)!important;">
                <img class="avatar user-thumb" src="{{ asset('images/user/'.Auth::user()->image) }}" alt="avatar">
                <h4 class="user-name dropdown-toggle text-dark" data-toggle="dropdown">{{ Auth::user()->name }} <i class="fa fa-angle-down"></i></h4>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Message</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="{{ route('update.user.get',Auth::user()->id) }}">Update Profile</a>
                    {{-- <a class="dropdown-item" href="#">Log Out</a> --}} 
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="dropdown-item underline text-sm text-gray-600 hover:text-gray-900">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page title area end -->
