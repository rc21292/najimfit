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
				<li class="breadcrumb-item"><a href="{{route('subscriptions.index')}}"> Controls</a></li>
				<li class="breadcrumb-item active" aria-current="page">Client List</li>
			</ol>
			<a href="{{route('clients.create')}}" class="ms-btn-icon btn-square btn-secondary"><i class="fas fa-plus"></i></a>
		</nav>
		@include('backend.admin.includes.flashmessage')
	</div>
	<div class="col-md-12">
		<div class="ms-panel">
			<div class="ms-panel-header">
				<h6>Client List</h6>
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
                  <a href="#" id="request_response" class="btn btn-block btn-primary">Request immediate response from nutritionist</a>
                  <p id="admin-request"></p>
                  <a href="#" id="defer_client" class="btn btn-block btn-warning">Defer Client</a>
                  <a href="#" style="display: none;" class="btn btn-block btn-success">Defer Chat</a>
                  <a href="#" id="block_client" class="btn btn-block btn-danger">Block Client from speaking</a>
                  <a href="#" id="block_nutritionist" class="btn btn-block btn-light">Block Nutritionist from replying</a>
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
	@foreach($clients as $client)
	[ "{{ $no++ }}" ,"{{ $client->firstname }} {{ $client->lastname}}"," {{ $client->email }}"," {{ $client->phone }}", @if($client->blocked_from_app) "<a href='{{route('unblock-user-from-app',$client->id)}}' class='btn btn-primary btnpro'>Unblock Client</a>" @else "<a href='{{route('block-user-from-app',$client->id)}}' class='btn btn-primary btnpro'>block Client</a>" @endif],
	@endforeach
	];
	var tablepackage = $('#data-table-18').DataTable( {
		data: dataSet18,
		columns: [
		{ title: "Id" },
		{ title: "Client Name" },
		{ title: "Email" },
		{ title: "Phone" },
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

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.js-example-basic-multiple').select2();
	});
</script>
<script type="text/javascript">
	$('#myModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget)
		var client_id = button.data('client');
		var request = button.data('request-date');
		var client_blocked = button.data('client-blocked');
		var nutri_blocked = button.data('nutri-blocked');
		var modal = $(this)
		modal.find('.modal-body #defer_client').attr('href', '/dashboard/chat-defer-client/'+client_id);
		modal.find('.modal-body #request_response').attr('href', '/dashboard/save-admin-request/'+client_id);
		if (client_blocked) {
			modal.find('.modal-body #block_client').attr('href', '/dashboard/unblock-client/'+client_id);
			modal.find('.modal-body #block_client').html('Unblock Client from speaking');
		}else{
			modal.find('.modal-body #block_client').attr('href', '/dashboard/block-client/'+client_id);
			modal.find('.modal-body #block_client').html('Block Client from speaking');
		}
		if (nutri_blocked) {
			modal.find('.modal-body #block_nutritionist').attr('href', '/dashboard/unblock-nutritionist/'+client_id);
			modal.find('.modal-body #block_nutritionist').html('Unblock Nutritionist from replying');
		}else{
			modal.find('.modal-body #block_nutritionist').attr('href', '/dashboard/block-nutritionist/'+client_id);
			modal.find('.modal-body #block_nutritionist').html('Block Nutritionist from replying');
		}
		if (request != '') {
		modal.find('.modal-body #admin-request').html('<center>Last Request on '+request+'</center>');
		}else{
			modal.find('.modal-body #admin-request').html('');
		}
		modal.find('.modal-body #client').val(client_id);
	})
</script>
@endpush