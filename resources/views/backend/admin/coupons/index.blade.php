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
				<li class="breadcrumb-item active" aria-current="page">Coupon List</li>
			</ol>
			<a href="{{route('coupons.create')}}" class="ms-btn-icon btn-square btn-secondary"><i class="fas fa-plus"></i></a>
		</nav>
		@include('backend.admin.includes.flashmessage')
	</div>
	<div class="col-md-12">
		<div class="ms-panel">
			<div class="ms-panel-header">
				<h6>Coupon List</h6>
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
	@foreach($coupons as $coupon)
	[ "{{ $no++ }}" ,"{{ $coupon->name }}"," {{ $coupon->code }}", "{{ $coupon->package }}", "{{ $coupon->type }}", "{{ $coupon->discount }}", @if($coupon->status == 'on')"Enabled" @else "Disabled" @endif , "<a href='{{route('coupons.edit',$coupon->id)}}'><i class='fas fa-pencil-alt ms-text-primary'></i></a> <a href='javascript:' onclick='submitform({{ $no }});'><i class='far fa-trash-alt ms-text-danger'></i></a><form id='delete-form{{$no}}' action='{{route('coupons.destroy',$coupon->id)}}' method='POST'><input type='hidden' name='_token' value='{{ csrf_token()}}'><input type='hidden' name='_method' value='DELETE'></form>"],
	@endforeach
	];
	var tablepackage = $('#data-table-18').DataTable( {
		data: dataSet18,
		columns: [
		{ title: "Id" },
		{ title: "Coupon Name" },
		{ title: "Code" },
		{ title: "Package" },
		{ title: "Type" },
		{ title: "Discount" },
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
			text: "Once deleted, you will not be able to recover this Coupon!",
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