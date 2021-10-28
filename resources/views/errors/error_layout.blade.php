<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('error_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
   
    @include('backend.layouts.partials.style')
    @stack('style')
</head>

<body>
   
    <div id="preloader">
        <div class="loader"></div>
    </div>

   
    <div class="error-area ptb--100 text-center">
        <div class="container">
            <div class="error-content">
                @yield('error-content')
                
            </div>
        </div>
    </div>
    <!-- error area end -->

   @include('backend.layouts.partials.scripts')
   @stack('scripts')
</body>

</html>