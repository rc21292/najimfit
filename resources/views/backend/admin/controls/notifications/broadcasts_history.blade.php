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
				<li class="breadcrumb-item"><a href="{{ route('notifications.index') }}"> Notifications</a></li>
				<li class="breadcrumb-item active" aria-current="page">Broadcasts History</li>
			</ol>
			<a href="{{route('notifications.index')}}" class="ms-btn-icon btn-square btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i></a>		
		</nav>
		@include('backend.admin.includes.flashmessage')
	</div>
	<div class="col-md-12">
		<div class="ms-panel">
			<div class="ms-panel-header">
				<h6>Broadcasts History</h6>
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
	@foreach($broadcasts_history as $broadcast_history)
	[ "{{ $no++ }}" ,"{{ $broadcast_history->firstname }} {{ $broadcast_history->lastname}}"," {{ $broadcast_history->message }}"," {{ $broadcast_history->message_type }}", @if($broadcast_history->status)"Sended" @else "Failed" @endif, @if($broadcast_history->from_subscriptions)"From Subscription" @else "From Notification" @endif],
	@endforeach
	];
	var tablepackage = $('#data-table-18').DataTable( {
		data: dataSet18,
		columns: [
		{ title: "Id" },
		{ title: "Client Name" },
		{ title: "Message" },
		{ title: "Message Type" },
		{ title: "Status" },
		{ title: "Message From Panel" },
		],

	});
</script>

@endpush