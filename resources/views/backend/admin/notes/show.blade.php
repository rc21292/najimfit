@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-12">
		<nav aria-label="breadcrumb " class="ms-panel-custom">
			<ol class="breadcrumb pl-0">
				<li class="breadcrumb-item"><a href="/"><i class="material-icons">home</i> Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('notes.index')}}">Notes</a></li>
				<li class="breadcrumb-item active" aria-current="page">Show Note</li>
			</ol>
		</nav>
		
	</div>
	<div class="col-xl-8 col-md-12">
		<div class="ms-panel ms-panel-fh">
			<div class="ms-panel-header">
				<h6>Note</h6>
				<a href='javascript:' onclick='submitform();' class='btn btn-danger btnpro float-right mb-2'>Delete</a>
				<form id='delete-form' action='{{route('notes.destroy',$note->id)}}' method='POST'>
					<input type='hidden' name='_token' value='{{ csrf_token()}}'>
					<input type='hidden' name='_method' value='DELETE'>
				</form>
			</div>
			<div class="ms-panel-body">
				<div class="form-row">
					<div class="col-xl-12 col-md-12 mb-1">
						<label>Note</label>
						<p>{{$note->note}}</p>
					</div>	
					<div class="col-xl-12 col-md-12 mb-1">
						<label>Created On</label>
						<p>{{$note->created_at}}</p>
					</div>	
					<div class="col-xl-12 col-md-12 mb-1">
						<label>Nutritionist:</label>
						<b>{!!$note->nutritionist_name!!}</b>
						<p></p>
					</div>	
					<div class="col-xl-12 col-md-12 mb-1">
						<label>Client:</label>
						<b>{{$note->client_name}}</b>
						<p></p>
					</div>					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
	function submitform(){
		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this Note!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				document.getElementById('delete-form').submit();
			}
		});
	}
</script>
@endpush