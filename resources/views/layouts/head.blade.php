<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<!-- Iconic Fonts -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="{{asset('backend/vendors/iconic-fonts/font-awesome/css/all.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('backend/vendors/iconic-fonts/flat-icons/flaticon.css')}}">
<link rel="stylesheet" href="{{asset('backend/vendors/iconic-fonts/cryptocoins/cryptocoins.css')}}">
<link rel="stylesheet" href="{{asset('backend/vendors/iconic-fonts/cryptocoins/cryptocoins-colors.css')}}">
<!-- Bootstrap core CSS -->
<link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet">
<!-- jQuery UI -->
<link href="{{asset('backend/assets/css/jquery-ui.min.css')}}" rel="stylesheet">
<!-- Page Specific CSS (Slick Slider.css) -->
<link href="{{asset('backend/assets/css/slick.css')}}" rel="stylesheet">
<!-- Greendash styles -->
<link href="{{asset('backend/assets/css/style.css')}}" rel="stylesheet">
<!-- Favicon -->
<link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon.ico')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@yield('head')