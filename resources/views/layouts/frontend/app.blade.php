<!doctype html>
<html lang="en">
<head>
	@include('layouts.frontend.head')
</head>
<body>
	@include('layouts.frontend.includes.header')
	
	@yield('content')

	@include('layouts.frontend.includes.footer')
</body>
</html>