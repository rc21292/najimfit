@extends('layouts.app')
@section('head')
<title>Appointments</title>
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<nav aria-label="breadcrumb " class="ms-panel-custom">
			<ol class="breadcrumb pl-0">
				<li class="breadcrumb-item"><a href="/"><i class="material-icons">home</i> Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Appointment List</li>
			</ol>
			<a href="{{route('appointments.create')}}" class="ms-btn-icon btn-square btn-secondary"><i class="fas fa-plus"></i></a>
		</nav>
		@include('backend.admin.includes.flashmessage')
	</div>
	<div class="col-md-12">
		<div class="ms-panel">
			<div class="ms-panel-header">
				<h6>Appointment List</h6>
			</div>
			<div class="ms-panel-body">
				<div class="table-responsive">
					<table id="data-table-10" class="table table-striped thead-primary w-100"></table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	var dataSet8 = [
	@foreach($appointments as $appointment)
	[ "{{ $no++ }}" ,"{{ $appointment->firstname }} {{ $appointment->lastname}}","{{$appointment->date}}", "{{ $appointment->time }} " ," {{ $appointment->phone }}", @if($appointment->status == '0')"Pending" @else "Attended" @endif , "<a class='btn btn-primary btnpro' href='{{route('appointments.edit',$appointment->id)}}'>Edit</a> <a href='javascript:' onclick='submitform({{ $no }});' class='btn btn-danger btnpro'>Delete</a><form id='delete-form{{$no}}' action='{{route('appointments.destroy',$appointment->id)}}' method='POST'><input type='hidden' name='_token' value='{{ csrf_token()}}'><input type='hidden' name='_method' value='DELETE'></form>"],
	@endforeach
	];
	var tablepackage = $('#data-table-10').DataTable( {
		data: dataSet8,
		columns: [
		{ title: "Id" },
		{ title: "Client Name" },
		{ title: "Date" },
		{ title: "Start Time" },
		{ title: "Phone" },
		{ title: "Status" },
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