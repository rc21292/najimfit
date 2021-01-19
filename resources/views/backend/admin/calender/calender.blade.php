@extends('layouts.app')
@section('head')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css" integrity="sha512-2e0Kl/wKgOUm/I722SOPMtmphkIjECJFpJrTRRyL8gjJSJIP2VofmEbqyApMaMfFhU727K3voz0e5EgE3Zf2Dg==" crossorigin="anonymous" />
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-sm-8">
				<nav aria-label="breadcrumb " class="ms-panel-custom">
					<ol class="breadcrumb pl-0">
						<li class="breadcrumb-item"><a href="/dashboard"><i class="material-icons">home</i> Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Calender</li>
					</ol>
				</nav>
			</div>
			<div class="col-sm-4" style="padding-left: 80px;">
				<button class="btn btn-warning mb-2" data-toggle="modal" data-target="#modal-15"> Add Appointment </button>
				<button class="btn btn-info mb-2" data-toggle="modal" data-target="#modal-16"> Add Event </button>
			</div>
		</div>
		@include('backend.admin.includes.flashmessage')
	</div>
	<div class="response"></div>
	<div id='calendar'></div>  
</div>
<div class="modal fade" id="modal-15" tabindex="-1" role="dialog" aria-labelledby="modal-15" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-max" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="col-xl-12 col-md-12">
					<div class="ms-panel ms-panel-fh">
						<div class="ms-panel-header">
							<h6>Add Appointment</h6>
						</div>
						<div class="ms-panel-body">
							<form class="needs-validation clearfix" method="POST" action="{{route('fullcalendar-save-appointment')}}" novalidate>
								@csrf
								<div class="form-row">
									<div class="col-xl-6 col-md-12 mb-3">
										<label for="firstname">Client firstname</label>
										<div class="input-group">
											<input type="text" id="firstname" name="firstname" class="form-control" placeholder="First Name" required>
											<div class="invalid-feedback">
												Please Enter a First Name.
											</div>
										</div>
									</div>
									<div class="col-xl-6 col-md-12 mb-3">
										<label for="lastname">Client lastname</label>
										<div class="input-group">
											<input type="text" id="lastname" name="lastname" class="form-control" placeholder="Last Name" required>
											<div class="invalid-feedback">
												Please Enter a Last Name.
											</div>
										</div>
									</div>
									<div class="col-xl-12 col-md-12 mb-3">
										<label for="gender">Gender</label>
										<div class="input-group">
											<select id="gender" name="gender" class="form-control" required>
												<option value="" selected>Choose Gender</option>
												<option value="male">Male</option>
												<option value="female">Female</option>
											</select>
											<div class="invalid-feedback">
												Please Select Gender.
											</div>
										</div>
									</div>
									<div class="col-xl-6 col-md-12 mb-3">
										<label for="phone">Phone</label>
										<div class="input-group">
											<input type="tel" id="phone" name="phone" class="form-control" placeholder="Phone" required>
											<div class="invalid-feedback">
												Please Enter Phone Number.
											</div>
										</div>
									</div>
									<div class="col-xl-6 col-md-12 mb-3">
										<label for="email">Email</label>
										<div class="input-group">
											<input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
											<div class="invalid-feedback">
												Please Enter Email.
											</div>
										</div>
									</div>
									<div class="col-xl-12 col-md-12 mb-3">
										<label for="start">Appointment Starts:</label>
										<div class="input-group">
											<input type="text" id="appointment-start" name="appointment_start" class="form-control" placeholder="Start time" required>
											<div class="invalid-feedback">
												Please Enter Start Time.
											</div>
										</div>
									</div>
									
									<div class="col-xl-12 col-md-12 mb-3">
										<label for="time">Comments</label>
										<div class="input-group">
											<textarea type="comments" id="comments" name="comments" class="form-control" placeholder="Comments"></textarea>
										</div>
									</div>			
								</div>
								
								<div class="d-flex justify-content-between">
									<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary shadow-none">Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-16" tabindex="-1" role="dialog" aria-labelledby="modal-15" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-max" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="col-xl-12 col-md-12">
					<div class="ms-panel ms-panel-fh">
						<div class="ms-panel-header">
							<h6>Add Event</h6>
						</div>
						<div class="ms-panel-body">
							<form class="needs-validation clearfix" method="POST" action="{{route('fullcalendar-save-event')}}" novalidate>
								@csrf
								<div class="form-row">
									<div class="col-xl-12 col-md-12 mb-3">
										<label for="firstname">Event Name</label>
										<div class="input-group">
											<input type="text" id="event" name="title" class="form-control" placeholder="Event Name" required>
											<div class="invalid-feedback">
												Please Enter a Event Name.
											</div>
										</div>
									</div>
									<div class="col-xl-12 col-md-12 mb-3">
										<label for="start">Event Starts:</label>
										<div class="input-group date">
											<input type="text" id="start" name="start" class="form-control" placeholder="Start time" required>
											<div class="invalid-feedback">
												Please Enter Start Time.
											</div>
										</div>
									</div>
									<div class="col-xl-12 col-md-12 mb-3">
										<label for="end">Event Ends:</label>
										<div class="input-group date">
											<input type="text" id="end" name="end" class="form-control" placeholder="End time" required>
											<div class="invalid-feedback">
												Please Enter End Time.
											</div>
										</div>
									</div>
									<div class="col-xl-12 col-md-12 mb-3">
										<label for="time">Comments</label>
										<div class="input-group">
											<textarea type="comments" id="comments" name="comments" class="form-control" placeholder="Comments" rows="3"></textarea>
										</div>
									</div>				
								</div>
								<div class="d-flex justify-content-between">
									<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary shadow-none">Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>

<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script type="text/javascript">
	$(function () {

		$('#start').datetimepicker({
			uiLibrary: 'bootstrap4',
			format:'yyyy:mm:dd:HH:mm:ss',
			modal: true,
			footer: true
		});
		$('#end').datetimepicker({
			uiLibrary: 'bootstrap4',
			format:'yyyy:mm:dd:HH:mm:ss',
			modal: true,
			footer: true
		});
		$('#appointment-start').datetimepicker({
			format:'yyyy:mm:dd:HH:mm:ss',
			uiLibrary: 'bootstrap4',
			modal: true,
			footer: true
		});
	});
</script>
<script>

	$(document).ready(function () {



		var SITEURL = "{{url('/')}}";

		$.ajaxSetup({

			headers: {

				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

			}

		});



		var calendar = $('#calendar').fullCalendar({

			editable: true,

			events: SITEURL + "/dashboard/fullcalendar",

			displayEventTime: true,

			editable: true,

			eventColor: 'yellow',

			eventRender: function (event, element, view) {
				console.log(element)
				if (event.allDay === 'true') {

					event.allDay = true;

				} else {

					event.allDay = false;

				}

			},

			selectable: true,

			selectHelper: true,

			select: function (start, end, allDay) {

				//var title = prompt('Event Title:');



				if (title) {

					var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");

					var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");



					$.ajax({

						url: SITEURL + "/dashboard/fullcalendar/create",

						data: 'title=' + title + '&start=' + start + '&end=' + end,

						type: "POST",

						success: function (data) {

							displayMessage("Added Successfully");

						}

					});

					calendar.fullCalendar('renderEvent',

					{

						title: title,

						start: start,

						end: end,

						allDay: allDay


					},

					true

					);

				}

				calendar.fullCalendar('unselect');

			},



			eventDrop: function (event, delta) {

				var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");

				var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");

				$.ajax({

					url: SITEURL + '/dashboard/fullcalendar/update',

					data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,

					type: "POST",

					success: function (response) {

						displayMessage("Updated Successfully");

					}

				});

			},

			eventClick: function (event) {

				var deleteMsg = confirm("Do you really want to delete?");

				if (deleteMsg) {

					$.ajax({

						type: "POST",

						url: SITEURL + '/dashboard/fullcalendar/delete',

						data: "&id=" + event.id,

						success: function (response) {

							if(parseInt(response) > 0) {

								$('#calendar').fullCalendar('removeEvents', event.id);

								displayMessage("Deleted Successfully");

							}

						}

					});

				}

			}



		});

	});


	function displayMessage(message) {

		$(".response").html(message
			);

		setInterval(function() { $(".success").fadeOut(); }, 1000);

	}

</script>
@endpush