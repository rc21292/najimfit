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
						<li class="breadcrumb-item active" aria-current="page">Table Category List</li>
					</ol>
				</nav>
			</div>
			<div class="col-sm-2" style="padding-left: 42px;">
				<a href="javascript:0" data-toggle="modal" data-target="#myModal" class="btn btn-square btn-primary mb-2"><i class="fas fa-plus"></i> Table</a>
			</div>
		</div>
		@include('backend.admin.includes.flashmessage')
	</div>
	<div class="col-md-12">
		<div class="ms-panel">
			<div class="ms-panel-header">
				<h6>Table List</h6>
			</div>
			<div class="ms-panel-body">
				<div class="table-responsive">
					<table id="data-table-12" class="table table-striped thead-primary w-100"></table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title has-icon ms-icon-round "><i class="flaticon-share bg-primary text-white"></i> Add Table</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="{{route('tables.store')}}" method="post">
				{{csrf_field()}}
				<div class="modal-body">
					<div class="ms-form-group has-icon">
						<label>Table Name</label>
						<input type="text" placeholder="Table Name" class="form-control" name="name" value="">
						<i class="fa fa-list"></i>
					</div>
					<div class="ms-form-group has-icon">
						<label>Sort Order</label>
						<input type="text" placeholder="Sort Order" class="form-control" name="sort" value="">
						<i class="fa fa-sort"></i>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title has-icon ms-icon-round "><i class="flaticon-share bg-primary text-white"></i> Edit Table</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="{{route('tables.update','test')}}" method="post">
				{{csrf_field()}}
				{{method_field('patch')}}
				<div class="modal-body">
					<input type="hidden" name="category_id" id="cat_id" value="">
					<div class="ms-form-group has-icon">
						<label>Table Name</label>
						<input type="text" placeholder="Table Name" id="name" class="form-control" name="name" value="">
						<i class="fa fa-list"></i>
					</div>
					<div class="ms-form-group has-icon">
						<label>Sort Order</label>
						<input type="text" placeholder="Sort Order" id="sort" class="form-control" name="sort" value="">
						<i class="fa fa-sort"></i>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	var dataSet12 = [
	@foreach($categories as $category)
	[ "{{ $no++ }}" ,"{{ $category->name }}","{{ $category->sort }}", "<a href='{{route('meals.show',$category->id)}}' class='btn btn-primary' style='margin-right:12px;'>Add Meal</a><a data-name='{{$category->name}}' data-sort='{{$category->sort}}' data-catid='{{$category->id}}' data-toggle='modal' data-target='#edit'><i class='fas fa-pencil-alt ms-text-primary'></i></a> <a href='javascript:' onclick='submitform({{ $no }});'><i class='far fa-trash-alt ms-text-danger'></i></a><form id='delete-form{{$no}}' action='{{route('tables.destroy',$category)}}' method='POST'><input type='hidden' name='_token' value='{{ csrf_token()}}'><input type='hidden' name='_method' value='DELETE'></form>"],
	@endforeach
	];
	var tablequestion = $('#data-table-12').DataTable( {
		data: dataSet12,
		columns: [
		{ title: "Id" }, 
		{ title: "Table Name" },
		{ title: "Sort" },
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
			text: "Once deleted, you will not be able to recover this Category!",
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
<script>
  
  $('#edit').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var name = button.data('name') 
      var sort = button.data('sort') 
      var cat_id = button.data('catid') 
      var modal = $(this)
      modal.find('.modal-body #name').val(name);
      modal.find('.modal-body #sort').val(sort);
      modal.find('.modal-body #cat_id').val(cat_id);
})
</script>
@endpush