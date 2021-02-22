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
						<li class="breadcrumb-item active" aria-current="page">Meal List</li>
					</ol>
				</nav>
			</div>
			<div class="col-sm-4" style="padding-left: 85px;">
				<a href="{{route('tables.index')}}" class="btn btn-square btn-danger mb-2"><i class="fas fa-list"></i> Tables</a>
				<a href="{{route('meals.create')}}" class="btn btn-square btn-primary mb-2"><i class="fas fa-plus"></i>  Add Meal</a>
			</div>
		</div>
		@include('backend.admin.includes.flashmessage')
	</div>
	<div class="col-md-12">
		<div class="ms-panel">
			<div class="ms-panel-header">
				<h6>Breakfast List</h6>
			</div>
			<div class="ms-panel-body">
				<div class="table-responsive">
					<table id="data-table-14" class="table table-striped thead-primary w-100"></table>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="ms-panel">
			<div class="ms-panel-header">
				<h6>Snacks List</h6>
			</div>
			<div class="ms-panel-body">
				<div class="table-responsive">
					<table id="data-table-15" class="table table-striped thead-primary w-100"></table>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="ms-panel">
			<div class="ms-panel-header">
				<h6>Lunch List</h6>
			</div>
			<div class="ms-panel-body">
				<div class="table-responsive">
					<table id="data-table-16" class="table table-striped thead-primary w-100"></table>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="ms-panel">
			<div class="ms-panel-header">
				<h6>Dinner List</h6>
			</div>
			<div class="ms-panel-body">
				<div class="table-responsive">
					<table id="data-table-17" class="table table-striped thead-primary w-100"></table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	var dataSet14 = [
	@foreach($meals as $meal)
	@if($meal->type == 'breakfast')
	[ "{{ $no++ }}" ,"{{ $meal->food }}","{{ $meal->calories }}"+" Cal", "{{ $meal->fat }}"+" gm", "<a href='{{route('meals.edit',$meal->id)}}'><i class='fas fa-pencil-alt ms-text-primary'></i></a> <a href='javascript:' onclick='submitform({{ $no }});'><i class='far fa-trash-alt ms-text-danger'></i></a><form id='delete-form{{$no}}' action='{{route('meals.destroy',$meal->id)}}' method='POST'><input type='hidden' name='_token' value='{{ csrf_token()}}'><input type='hidden' name='_method' value='DELETE'></form>"],
	@endif
	@endforeach
	];
	var tableworkouts = $('#data-table-14').DataTable( {
		data: dataSet14,
		columns: [
		{ title: "Id" },
		{ title: "Food" },
		{ title: "Calories" },
		{ title: "Fat" },
		{ title: "Action" },
		],

	});
	
</script>
<script>
	var dataSet15 = [
	@foreach($meals as $meal)
	@if($meal->type == 'snacks')
	[ "{{ $no++ }}" ,"{{ $meal->food }}","{{ $meal->calories }}"+" Cal", "{{ $meal->fat }}"+" gm", "<a href='{{route('meals.edit',$meal->id)}}'><i class='fas fa-pencil-alt ms-text-primary'></i></a> <a href='javascript:' onclick='submitform({{ $no }});'><i class='far fa-trash-alt ms-text-danger'></i></a><form id='delete-form{{$no}}' action='{{route('meals.destroy',$meal->id)}}' method='POST'><input type='hidden' name='_token' value='{{ csrf_token()}}'><input type='hidden' name='_method' value='DELETE'></form>"],
	@endif
	@endforeach
	];
	var tableworkouts = $('#data-table-15').DataTable( {
		data: dataSet15,
		columns: [
		{ title: "Id" },
		{ title: "Food" },
		{ title: "Calories" },
		{ title: "Fat" },
		{ title: "Action" },
		],

	});
	
</script>
<script>
	var dataSet16 = [
	@foreach($meals as $meal)
	@if($meal->type == 'lunch')
	[ "{{ $no++ }}" ,"{{ $meal->food }}","{{ $meal->calories }}"+" Cal", "{{ $meal->fat }}"+" gm", "<a href='{{route('meals.edit',$meal->id)}}'><i class='fas fa-pencil-alt ms-text-primary'></i></a> <a href='javascript:' onclick='submitform({{ $no }});'><i class='far fa-trash-alt ms-text-danger'></i></a><form id='delete-form{{$no}}' action='{{route('meals.destroy',$meal->id)}}' method='POST'><input type='hidden' name='_token' value='{{ csrf_token()}}'><input type='hidden' name='_method' value='DELETE'></form>"],
	@endif
	@endforeach
	];
	var tableworkouts = $('#data-table-16').DataTable( {
		data: dataSet16,
		columns: [
		{ title: "Id" },
		{ title: "Food" },
		{ title: "Calories" },
		{ title: "Fat" },
		{ title: "Action" },
		],

	});
	
</script>
<script>
	var dataSet17 = [
	@foreach($meals as $meal)
	@if($meal->type == 'dinner')
	[ "{{ $no++ }}" ,"{{ $meal->food }}","{{ $meal->calories }}"+" Cal", "{{ $meal->fat }}"+" gm", "<a href='{{route('meals.edit',$meal->id)}}'><i class='fas fa-pencil-alt ms-text-primary'></i></a> <a href='javascript:' onclick='submitform({{ $no }});'><i class='far fa-trash-alt ms-text-danger'></i></a><form id='delete-form{{$no}}' action='{{route('meals.destroy',$meal->id)}}' method='POST'><input type='hidden' name='_token' value='{{ csrf_token()}}'><input type='hidden' name='_method' value='DELETE'></form>"],
	@endif
	@endforeach
	];
	var tableworkouts = $('#data-table-17').DataTable( {
		data: dataSet17,
		columns: [
		{ title: "Id" },
		{ title: "Food" },
		{ title: "Calories" },
		{ title: "Fat" },
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