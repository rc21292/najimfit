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
				<li class="breadcrumb-item"><a href="{{route('assign-table.index')}}">Nutritionist</a></li>
				<li class="breadcrumb-item active" aria-current="page">Client List</li>
			</ol>
			<a href="{{route('assign-table.index')}}" class="ms-btn-icon btn-square btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i></i></a>
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
			<div class="ms-panel-body">
                  <a href="#" class="btn btn-block btn-primary">Request immediate response from nutritionist</a>
                  <a href="#" class="btn btn-block btn-warning">Defer Client</a>
                  <a href="#" class="btn btn-block btn-success">Defer Chat</a>
                  <a href="#" class="btn btn-block btn-danger">Block Client from speaking</a>
                  <a href="#" class="btn btn-block btn-light">Block Nutritionist from replying</a>
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
	[
	"{{ $no++}}" ,"<a href='{{route('renew-table.edit',$client->client_id)}}'><img src='https://via.placeholder.com/216x62' style='width:50px; height:30px;'> {{ $client->firstname }} {{ $client->lastname}}</a>", "<a href='{{route('client-full-profile.show',$client->id)}}' class='btn btn-primary btnpro'>Profile</a><a href='{{route('labels.show',$client->client_id)}}'class='btn btn-primary btnpro'>Labels</a><a href='{{route('clients.edit',$client->id)}}' class='btn btn-success btnpro'>Chat</a><a href='javascript:' data-toggle='modal' data-target='#myModal' class='btn btn-danger btnpro'>Actions</a><a href='{{route('clients.edit',$client->id)}}' class='btn btn-info btnpro'>Send Note</a>","{{ $client->assigned_on}}<br>{{ $client->name }}"],
	@endforeach
	];

	var tableClient = $('#data-table-18').DataTable( {
		data: dataSet18,
		columns: [
		{ title: "Id" },
		{ title: "Client Name" },
		{ title: "Action" },
		{ title: "Nutritionist" },

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