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
						<li class="breadcrumb-item active" aria-current="page">Question List</li>
					</ol>
				</nav>
			</div>
			<div class="col-sm-4" style="padding-left: 80px;">
				<a href="{{route('question-category.index')}}" class="btn btn-square btn-danger mb-2"><i class="fas fa-list"></i> Categories</a>
				<a href="{{route('question.create')}}" class="btn btn-square btn-primary mb-2"><i class="fas fa-plus"></i>  Add Question</a>
			</div>
		</div>
		@include('backend.admin.includes.flashmessage')
	</div>
	<div class="col-md-12">
		<div class="ms-panel">
			<div class="ms-panel-header">
				<h6>Question List</h6>
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
	var dataSet7 = [
	@foreach($questions as $question)
	[ "{{ $no++ }}" ,"{{ $question->question }}","{{ $question->sort }}", "<a href='{{route('question.edit',$question)}}'><i class='fas fa-pencil-alt ms-text-primary'></i></a> <a href='javascript:' onclick='submitform({{ $no }});'><i class='far fa-trash-alt ms-text-danger'></i></a><form id='delete-form{{$no}}' action='{{route('question.destroy',$question)}}' method='POST'><input type='hidden' name='_token' value='{{ csrf_token()}}'><input type='hidden' name='_method' value='DELETE'></form>"],
	@endforeach
	];
	var tablequestion = $('#data-table-9').DataTable( {
		data: dataSet7,
		columns: [
		{ title: "Id" },
		{ title: "Question Name" },
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