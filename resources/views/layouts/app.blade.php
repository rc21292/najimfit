<!DOCTYPE html>
<html>
<head>
	@include('layouts.head')
</head>
<body class="ms-body ms-aside-left-open ms-primary-theme ">
	<!-- Preloader -->
	<div id="preloader-wrap">
		{{-- <div class="spinner spinner-9">
			<div class="ms-cube ms-cube1"></div>
			<div class="ms-cube ms-cube2"></div>
			<div class="ms-cube ms-cube3"></div>
			<div class="ms-cube ms-cube4"></div>
			<div class="ms-cube ms-cube5"></div>
			<div class="ms-cube ms-cube6"></div>
			<div class="ms-cube ms-cube7"></div>
			<div class="ms-cube ms-cube8"></div>
			<div class="ms-cube ms-cube9"></div>
		</div> --}}
	</div>
	<!-- Overlays -->
	<div class="ms-aside-overlay ms-overlay-left ms-toggler" data-target="#ms-side-nav" data-toggle="slideLeft"></div>
	<div class="ms-aside-overlay ms-overlay-right ms-toggler" data-target="#ms-recent-activity" data-toggle="slideRight"></div>
	@include('backend.admin.includes.sidebar')
	<!-- Main Content -->
	<main class="body-content">
		@include('backend.admin.includes.header')
		<div class="ms-content-wrapper">
			
			@yield('content')

		</div>
	</main>
	@include('backend.admin.includes.footer')
</body>
</html>