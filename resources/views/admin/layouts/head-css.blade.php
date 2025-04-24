@yield('css')

<!-- preloader css -->
<link rel="stylesheet" href="{{ URL::asset('admin/assets/css/preloader.min.css') }}" type="text/css" />

<!-- Bootstrap Css -->
<link href="{{ URL::asset('admin/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ URL::asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ URL::asset('admin/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<meta name="csrf-token" content="{{ csrf_token() }}">
