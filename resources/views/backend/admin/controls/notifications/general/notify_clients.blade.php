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
								<h6>Send general Notification to Clients
									<a style="float: right;margin-top: -10px" href="{{route('notifications.index')}}" class="ms-btn-icon btn-square btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i></a>								
							</div>
							<div class="ms-panel-body">
								<form id="form-id" action="{{route('send-general-push-notification')}}" method="post">
									{{csrf_field()}}
									<div class="modal-body">
										<div class="ms-form-group has-icon">
											<label>Select Label(s)</label><br>
											<select class="js-example-basic-multiple" name="labels[]" id="client_id" multiple="multiple" style="width: 100%">
												<option value="High Priority">High Priority</option>
												<option value="Diabetic" >Diabetic</option>
												<option value="Sick" >Sick</option>
											</select>
										<div id="error" style="color: red"></div>
										</div>

										<div class="ms-form-group has-icon">
											<div class="checkbox">
												<label>
													<input name="all_clients" value="1" type="checkbox" class="check" id="checkAll"> Send notification to all clients.
												</label>
											</div>
										</div>

										<div class="ms-form-group has-icon">
											<label><b>message: </b></label><br>
											<textarea name="message" id="message" rows="5" class="form-control"></textarea>
											<div id="error_msg" style="color: red"></div>
										</div> 

									</div>
									<div class="modal-footer">
										<a href='javascript:' onclick='submitform();' class="btn btn-primary">Notify</a>
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
	$( document ).ready(function() {
		setTimeout(function() {
			$('.alert-success').fadeOut('fast');
		}, 2200);
	});
</script>
<script type="text/javascript">
	function submitform(){
		$("#error").html('');
		$("#error_msg").html('');		
		if (!$("#checkAll").is(":checked")) 
		{
			if ($("#client_id").val() == '') 
			{
				$("#client_id").focus();
				$("#error").html('Please select Label');
				return false;
			}		
		}
		if ($("textarea#message").val() == '') {
			$("#message").focus();
			$("#error_msg").html('Please Enter message');
			return false;
		}
		swal({
			title: "Are you sure?",
			text: "to Send message!",
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

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.js-example-basic-multiple').select2({
			tags: true,
			tokenSeparators: [',', ' ']
		});
	});


$('.js-example-basic-multiple').on("select2:select", function (e) { 
           var data = e.params.data.text;
           if(data=='Select All Clients'){
            $(".js-example-basic-multiple > option").prop("selected","selected");
            $(".js-example-basic-multiple").trigger("change");
           }
      });


</script>

@endpush
