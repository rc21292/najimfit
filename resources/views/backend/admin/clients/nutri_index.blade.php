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
				<div class="" style="float: right; margin-top: -23px;"> 
					<select id="filter" class="select-inline" style="height: 40px;" name="filter">
						<option value="">Select to Filter Clients</option>
						<option @if(@$filter=="waiting") selected @endif value="waiting">Filter Waiting List Clients</option>
						<option @if(@$filter=="block") selected @endif value="block">Filter Block Clients</option>
					</select>
					
					<button type="button" id="button-filter" class="btn btn-danger"><i class="fa fa-filter"></i>&nbsp;Filter</button>
					<button type="button" id="reset-filter" class="btn btn-danger"><i class="fa fa-refresh"></i>&nbsp;Reset</button>
				</div>
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
	@foreach($clients as $client)
	[ "{{ $no++ }}" ,"{{ $client->firstname }} {{ $client->lastname}} @if($client->is_client_in_wating) <i style='color:red' title='This Client is in Waitinglist' class='fas fa-info-circle'></i> @endif @if($client->is_new_notes == 1) <a href='{{route('notes.index',['id'=>$client->id])}}'><span class='badge badge-outline-info'> {{$client->notes_count }} New Note</span></a> @endif"," {{ $client->phone }}", "{{ $client->lables}}", @if($client->status == 'on')"Enabled" @else "Disabled" @endif , "<a href='{{route('client-full-profile.show',$client->id)}}' class='btn btn-primary btnpro'>Profile</a><a href='{{route('labels.show',$client->id)}}'class='btn btn-primary btnpro'>Labels</a><a href='{{route('chat.show',$client->id)}}' class='btn btn-success btnpro'>Chat</a> @if($client->is_deferd)<a href='{{route('requests.index')}}' class='btn btn-info btnpro'>Defer</a> @else <a href='{{route('defer',$client->id)}}' class='btn btn-info btnpro'>Defer</a> @endif @if($client->is_complaint)<a href='{{route('complaints.index')}}' class='btn btn-info btnpro'>Post Complaint</a> @else <a href='{{route('post-complaint',$client->id)}}' class='btn btn-info btnpro'>Post Complaint</a> @endif <a class='btn btn-primary btnpro' href='{{route('clients.edit',$client->id)}}'>Edit</a><a href='javascript:' onclick='submitform({{ $no }});' class='btn btn-danger btnpro'>Delete</a><form id='delete-form{{$no}}' action='{{route('clients.destroy',$client->id)}}' method='POST'><input type='hidden' name='_token' value='{{ csrf_token()}}'><input type='hidden' name='_method' value='DELETE'></form>"],
	@endforeach
	];
	var tablepackage = $('#data-table-18').DataTable( {
		data: dataSet18,
		columns: [
		{ title: "Id" },
		{ title: "Client Name" },
		{ title: "Phone" },
		{ title: "Lables" },
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
<script type="text/javascript">
	$('#reset-filter').on('click', function() {
		url = '{{route('clients.index')}}';
		location = url;
	});
	$('#button-filter').on('click', function() {
		if ($('#filter').find(":selected").val() == '') {
			url = '{{route('clients.index')}}';
		}else{
			url = '{{route('clients.index')}}';
		}
		var filter_type = $('#filter').find(":selected").val();
		if (filter_type) {
			url += '?filter=' + encodeURIComponent(filter_type);
		}
		location = url;
	});
</script>
@endpush