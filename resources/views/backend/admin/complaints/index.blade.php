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
				<li class="breadcrumb-item active" aria-current="page">Complaints List</li>
			</ol>
		</nav>
		@include('backend.admin.includes.flashmessage')
	</div>
	<div class="col-md-12">
		<div class="ms-panel">
			<div class="ms-panel-header">
				<h6>Complaints List</h6>
			</div>
			<div class="ms-panel-body">
				<div class="table-responsive">
					<table id="data-table-18" class="table table-striped thead-primary w-100"></table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title text-center">Client Actions</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="ms-panel-body modal-body">
				<input type="hidden" name="client_id" id="client" value="">
				<a href="#" class="btn btn-block btn-warning">Defer Client</a>
				<a href="#" class="btn btn-block btn-success">View Chat</a>
				<a href="#" class="btn btn-block btn-danger">View Table</a>
				<a href="#" class="btn btn-block btn-light">View Workout</a>
				<a id="view_profile" href="#" class="btn btn-block btn-light">View Profile</a>
            </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	var dataSet18 = [
	@foreach($complaints as $request)
	[ "{{ $no++ }}" ,"{{ $request->nutritionist_name }}"," {{ $request->client_name}}<br>{{ $request->client_id}}","{{ $request->reason }}", "<a href='javascript:' data-toggle='modal' data-target='#myModal' data-client='{{$request->client_id}}' class='btn btn-danger btnpro'>Actions</a>"],
	@endforeach
	];
	var tablepackage = $('#data-table-18').DataTable( {
		data: dataSet18,
		columns: [
		{ title: "Id" },
		{ title: "Nutritionist Name" },
		{ title: "Client" },
		{ title: "Description" },
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
<script type="text/javascript">
	$('#myModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) 
		var client_id = button.data('client')  
		var modal = $(this)
		modal.find('.modal-body #view_profile').attr('href', '/dashboard/client-full-profile/'+client_id);
		modal.find('.modal-body #client').val(client_id);
	})
</script>
@endpush