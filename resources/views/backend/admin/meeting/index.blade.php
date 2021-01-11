@extends('layouts.app')
@section('head')
<link href="{{asset('backend/assets/css/datatables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-sm-10">
				<nav aria-label="breadcrumb " class="ms-panel-custom">
					<ol class="breadcrumb pl-0">
						<li class="breadcrumb-item"><a href="/"><i class="material-icons">home</i> Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Meeting List</li>
					</ol>
				</nav>
			</div>
			<div class="col-sm-2">
				<a href="{{route('meeting.create')}}" class="btn btn-square btn-primary mb-2"><i class="fas fa-plus"></i>  Add Meeting</a>
			</div>
		</div>
		@include('backend.admin.includes.flashmessage')
	</div>
	<div class="col-md-12">
		<div class="ms-panel">
			<div class="ms-panel-header">
				<h6>Meetings List</h6>
			</div>
			<div class="ms-panel-body">
				<div class="table-responsive">
					<table id="data-table-28" class="table table-striped thead-primary w-100"></table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@push('scripts')
<script>
	var dataSet18 = [
	@foreach($meetings as $meeting)
	[ "{{ $no++ }}" ,"{{ $meeting->name }}", "{{$meeting->date}}", " {{ $meeting->start}}","{{ $meeting->end}}", "<a href='{{route('meeting.edit',$meeting->id)}}'><i class='fas fa-pencil-alt ms-text-primary'></i></a> <a href='javascript:' onclick='submitform({{ $no }});'><i class='far fa-trash-alt ms-text-danger'></i></a><form id='delete-form{{$no}}' action='{{route('meeting.destroy',$meeting->id)}}' method='POST'><input type='hidden' name='_token' value='{{ csrf_token()}}'><input type='hidden' name='_method' value='DELETE'></form>"],
	@endforeach
	];
	var tablepackage = $('#data-table-28').DataTable( {
		data: dataSet18,
		columns: [
		{ title: "Id" },
		{ title: "Meeting Name" },
		{ title: "Date" },
		{ title: "Start" },
		{ title: "End" },
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
			text: "Once deleted, you will not be able to recover this Meeting!",
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