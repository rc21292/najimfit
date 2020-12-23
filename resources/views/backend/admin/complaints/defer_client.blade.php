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
								<h6>Assign Client to Nutritionist 

									<a style="float: right;margin-top: -10px" href="{{ URL::previous() }}" class="ms-btn-icon btn-square btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i></a>								
							</div>
							<div class="ms-panel-body">
								<form id="form-id" action="{{route('assign-to-nutritionist')}}" method="post">
									{{csrf_field()}}
									<div class="modal-body">
										<div class="ms-form-group has-icon">
											<label><b>Client Name</b></label>: {{$client_name}}
											
										</div>

										<div class="ms-form-group has-icon">
											<label><b>Nutritionist Name</b></label>: {{$nutritionist_name}}
										</div>

										<div class="ms-form-group has-icon">
											<label><b>Select Nutritionist</b></label><br>
											<select required class="js-example-basic-multiple" id="nutritionist_id" name="nutritionist" style="width: 100%">
												<option value="">Select Nutritionist</option>
												@foreach($nutritionists as $row)
												<option value="{{$row->id}}">{{$row->name}}</option>
												@endforeach
											</select>
											<div id="error" style="color: red"></div>
										</div>

										<input type="hidden" id="client" name="client_id" value="{{$client_id}}">
										<input type="hidden" id="id" name="id" value="{{$id}}">
									</div>
									<div class="modal-footer">
										<a href='javascript:' onclick='submitform();' class="btn btn-primary">Assign</a>
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
		if ($("#nutritionist_id").val() == '') {
			$("#nutritionist_id").focus();
			$("#error").html('Please select Nutritionist');
			return false;
		}
		swal({
			title: "Are you sure?",
			text: "Assign this client to another Nutritionist!",
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
