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
				<li class="breadcrumb-item active" aria-current="page">Intake Substances</li>
			</ol>
		</nav>
		@include('backend.admin.includes.flashmessage')
	</div>
	<div class="col-md-12">
		<div class="ms-panel">
			<div class="ms-panel-header">
				<h6>Intake Substances List</h6>
				<a style="float: right; margin-top: -25px" href="{{ route('intake-substances.index') }}" class="ms-btn-icon btn-square btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i></a>
			</div>
			<div class="ms-panel-body">
				<div class="table-responsive">
					<table id="data-table-18" class="table table-striped thead-primary w-100"></table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	var dataSet18 = [
	@foreach($intake_subs as $intake_subs1)
	@foreach($intake_subs1 as $intake_sub)
	[ "{{ $no++ }}" ," {{ $intake_sub->diet_type }}", "{{ $intake_sub->serving_size }}", "{{ $intake_sub->grams_per_serving }}" , "{{ $intake_sub->time }}", "<a class='btn btn-primary btnpro' href='{{route('view-diets',$intake_sub->id)}}'>View Details</a> <a class='btn btn-info btnpro' href='{{route('view-comments',$intake_sub->id)}}'>View Comments</a>"],
	@endforeach
	@endforeach
	];
	var tablepackage = $('#data-table-18').DataTable( {
		data: dataSet18,
		columns: [
		{ title: "Id" },
		// { title: "Client Name" },
		{ title: "Diet Type" },
		{ title: "Serving Size" },
		{ title: "Grams Per Serving" },
		{ title: "Time" },
		{ title: "Action" },
		],

	});
</script>
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