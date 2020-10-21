@extends('layouts.app')
@section('head')
<link href="{{asset('backend/assets/css/datatables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-sm-8">
				<nav aria-label="breadcrumb " class="ms-panel-custom">
					<ol class="breadcrumb pl-0">
						<li class="breadcrumb-item"><a href="/"><i class="material-icons">home</i> Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Exercise List</li>
					</ol>
				</nav>
			</div>
			<div class="col-sm-4" style="padding-left: 85px;">
				<a href="{{route('workout-informations')}}" class="btn btn-square btn-warning mb-2"><i class="fas fa-list"></i> Information</a>
				<a href="{{route('workout-category.index')}}" class="btn btn-square btn-danger mb-2"><i class="fas fa-list"></i> Categories</a>
				<a href="{{route('exercise.create')}}" class="btn btn-square btn-primary mb-2"><i class="fas fa-plus"></i>  Add Exercise</a>
			</div>
		</div>
		@include('backend.admin.includes.flashmessage')
	</div>
	<div class="col-md-12">
		<div class="ms-panel">
			<div class="ms-panel-header">
				<h6>Exercise List</h6>
			</div>
			<div class="ms-panel-body">
				<div class="table-responsive">
					<table id="data-table-9" class="table table-striped thead-primary w-100"></table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	var dataSet9 = [
	@foreach($exercises as $exercise)
	[ "{{ $no++ }}" ,"{{ $exercise->name }}","{{ $exercise->category }}", "{{ $exercise->calories }}"+" Cal", "<a href='{{route('exercise.edit',$exercise->id)}}'><i class='fas fa-pencil-alt ms-text-primary'></i></a> <a href='javascript:' onclick='submitform({{ $no }});'><i class='far fa-trash-alt ms-text-danger'></i></a><form id='delete-form{{$no}}' action='{{route('exercise.destroy',$exercise->id)}}' method='POST'><input type='hidden' name='_token' value='{{ csrf_token()}}'><input type='hidden' name='_method' value='DELETE'></form>"],
	@endforeach
	];
	var tableworkouts = $('#data-table-9').DataTable( {
		data: dataSet9,
		columns: [
		{ title: "Id" },
		{ title: "Exercise Name" },
		{ title: "Category" },
		{ title: "Calories Range" },
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
			text: "Once deleted, you will not be able to recover this Question!",
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