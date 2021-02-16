@extends('layouts.app')
@section('head')
<link href="{{asset('backend/assets/css/datatables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<nav aria-label="breadcrumb " class="ms-panel-custom">
			<ol class="breadcrumb pl-0">
				<li class="breadcrumb-item"><a href="/"><i class="material-icons">home</i> Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Assign package</li>
			</ol>
			
		</nav>

		
		@if (session()->has('success'))
		<div class="alert alert-success" role="alert">
			<i class="flaticon-tick-inside-circle"></i> <strong>Well done!</strong> {{ session('success') }}
		</div>
		@endif


		@if (session()->has('error'))
		<div class="alert alert-warning" role="alert">
			<i class="flaticon-alert"></i> <strong>Warning!</strong> {{ session('error') }}
		</div>
		
		@endif

	</div>
	<div class="col-md-12">
		<div class="ms-panel">
			<div class="ms-panel-header">
				<h6>Assign package</h6>
			</div>
			<div class="ms-panel-body">			
				<form class="needs-validation clearfix" method="POST" action="{{route('assign-package-to-client')}}" novalidate>
					@csrf
					<input type="hidden" name="client_id" value="{{ $client_id }}">
					<input type="hidden" name="package_id" value="{{ $package_id }}">					
					<center><button class="btn btn-primary" type="submit">Assign Package to Client</button></center>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
	$( document ).ready(function() {
		setTimeout(function() {
			$('.alert-success').fadeOut('fast');
		}, 2200);
	});
</script>
<script type="text/javascript">
	function submitform(no){
		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this Package!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				document.getElementById('delete-form'+no).submit();
			}
		});
	}
</script>
@endpush