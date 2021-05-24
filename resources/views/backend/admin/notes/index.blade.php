@extends('layouts.app')
@section('head')
<link href="{{asset('backend/assets/css/datatables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<nav aria-label="breadcrumb " class="ms-panel-custom">
			<ol class="breadcrumb pl-0">
				<li class="breadcrumb-item"><a href="/dashboard"><i class="material-icons">home</i> Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Notes List</li>
			</ol>
			<a  href="{{route('home')}}" class="ms-btn-icon btn-square btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i></a>	
		</nav>
		@include('backend.admin.includes.flashmessage')
	</div>
	<div class="col-md-12">
		<div class="ms-panel">
			<div class="ms-panel-header">
				<h6>Notes List</h6>
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
	@foreach($requests as $request)
	[ "{{ $no++ }}" ,"{{ $request->nutritionist_name }}"," <a href='{{route('client-full-profile.show',$request->client_id)}}' >{{ $request->client_name}}</a><br>ID: {{ $request->client_id}}","{{ $request->note }}"],
	@endforeach
	];
	var tablepackage = $('#data-table-18').DataTable( {
		data: dataSet18,
		columns: [
		{ title: "Id" },
		{ title: "Nutritionist Name" },
		{ title: "Client" },
		{ title: "Description" },
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
		var client_id = button.data('client');
		var request_id = button.data('id');
		var modal = $(this)
		modal.find('.modal-body #view_profile').attr('href', '/dashboard/client-full-profile/'+client_id);
		modal.find('.modal-body #defer_client').attr('href', '/dashboard/defer-client/'+request_id);
		modal.find('.modal-body #view_chat').attr('href', '/dashboard/view-chat/'+request_id);
		modal.find('.modal-body #view_table').attr('href', '/dashboard/assign-table/'+client_id+'/edit');
		modal.find('.modal-body #view_workout').attr('href', '/dashboard/assign-workout/'+client_id+'/edit');
		modal.find('.modal-body #client').val(client_id);
	})
</script>
@endpush