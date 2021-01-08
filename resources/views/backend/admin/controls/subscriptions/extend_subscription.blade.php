@extends('layouts.app')
@section('head')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
@include('backend.admin.includes.flashmessage')
<div class="col-xl-12 col-md-12">
	<div class="col-xl-12">
		<div class="ms-panel">
			<div class="ms-panel-body">
				<div class="row">
					<div class="col-md-12">
						<div class="ms-panel">
							<div class="ms-panel-header">
								<h6>Extend subscription of Client
									<a style="float: right;margin-top: -10px" href="{{ URL::previous() }}" class="ms-btn-icon btn-square btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i></a>								
							</div>
							<div class="ms-panel-body">
								<form id="form-id" action="{{route('extend-subscription')}}" method="post">
									{{csrf_field()}}
									<div class="modal-body">
										<div class="ms-form-group has-icon">
											<label><b>Select Client To block</b></label><br>
											<select required class="js-example-basic-multiple" id="client_id" name="client" style="width: 100%">
												<option value="">Select Client</option>
												@foreach($clients as $client)
												<option value="{{$client->id}}">{{$client->firstname}} {{$client->lastname}}</option>
												@endforeach
											</select>
											<div id="error" style="color: red"></div>
										</div>

										<div class="ms-form-group has-icon">
											<label><b>No of day's</b></label><br>
											<input type="number" id="days" class="form-control" name="days" required>
											<div id="error_days" style="color: red"></div>
										</div>

									</div>
									<div class="modal-footer">
										<a href='javascript:' onclick='submitform();' class="btn btn-primary">Submit</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.js-example-basic-multiple').select2({
			tags: true,
			tokenSeparators: [',', ' ']
		});
	});
</script>
<script type="text/javascript">
	$( document ).ready(function() {
		setTimeout(function() {
			$('.alert-success').fadeOut('fast');
		}, 2200);
	});
</script>
<script type="text/javascript">
	function submitform(){
		$("#error").html('');
		$("#error_days").html('');
		if ($("#client_id").val() == '') {
			$("#client_id").focus();
			$("#error").html('Please select Client');
			return false;
		}
		if ($("#days").val() == '') {
			$("#days").focus();
			$("#error_days").html('Please Enter Days');
			return false;
		}
		swal({
			title: "Are you sure?",
			text: "to Extend Subscription of client!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				document.getElementById('form-id').submit();
			}
		});
	}
</script>
@endpush
