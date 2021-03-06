@extends('layouts.app')
@section('head')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css" integrity="sha512-2e0Kl/wKgOUm/I722SOPMtmphkIjECJFpJrTRRyL8gjJSJIP2VofmEbqyApMaMfFhU727K3voz0e5EgE3Zf2Dg==" crossorigin="anonymous" />
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<nav aria-label="breadcrumb " class="ms-panel-custom">
			<ol class="breadcrumb pl-0">
				<li class="breadcrumb-item"><a href="/"><i class="material-icons">home</i> Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('appointments.index')}}">Clients List</a></li>
				<li class="breadcrumb-item active" aria-current="page">Add Appointment</li>
			</ol>
		</nav>
	</div>
	<div class="col-xl-8 col-md-12">
		<div class="ms-panel ms-panel-fh">
			<div class="ms-panel-header">
				<h6>Appointment Form</h6>
			</div>
			<div class="ms-panel-body">
				<form class="needs-validation clearfix" method="POST" action="{{route('appointments.update',$id)}}" novalidate>
					@csrf
					{{ method_field('PUT') }}
					<div class="form-row">
						<div class="col-xl-6 col-md-12 mb-3">
							<label for="firstname">Client firstname</label>
							<div class="input-group">
								<input type="text" id="firstname" name="firstname" class="form-control" placeholder="First Name" value="{{ $appointment->firstname }}" required>
								<div class="invalid-feedback">
									Please Enter a First Name.
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-12 mb-3">
							<label for="lastname">Client lastname</label>
							<div class="input-group">
								<input type="text" id="lastname" name="lastname" class="form-control" placeholder="Last Name" value="{{ $appointment->lastname }}" required>
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
									<option value="male" @if($appointment->gender == 'male') selected @endif>Male</option>
									<option value="female" @if($appointment->gender == 'female') selected @endif>Female</option>
								</select>
								<div class="invalid-feedback">
									Please Select Gender.
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-12 mb-3">
							<label for="phone">Phone</label>
							<div class="input-group">
								<input type="tel" id="phone" name="phone" class="form-control" placeholder="Phone" required value="{{ $appointment->phone }}">
								<div class="invalid-feedback">
									Please Enter Phone Number.
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-12 mb-3">
							<label for="email">Email</label>
							<div class="input-group">
								<input type="email" id="email" value="{{ $appointment->email }}" name="email" class="form-control" placeholder="Email" required>
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
								<textarea type="comments" id="comments" name="comments" class="form-control" placeholder="Comments">{{ $appointment->comments }}</textarea>
							</div>
						</div>			
					</div>
					<div class="col-md-12 pt-4">
						<label class="ms-switch">
							<input type="checkbox" name="status" @if($appointment->status == "1") checked="" @endif>
							<span class="ms-switch-slider ms-switch-primary square"></span>
						</label>
						<span> Attended </span>
					</div>					
				</div>
				<button class="btn btn-primary float-right" type="submit">Save</button>
			</form>
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
		$('#appointment-start').datetimepicker({
			format:'yyyy:mm:dd:HH:mm:ss',
			uiLibrary: 'bootstrap4',
			modal: true,
			footer: true
		});
	});
</script>
@endpush