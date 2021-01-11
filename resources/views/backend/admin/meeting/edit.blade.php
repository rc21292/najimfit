@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-12">
		<nav aria-label="breadcrumb " class="ms-panel-custom">
			<ol class="breadcrumb pl-0">
				<li class="breadcrumb-item"><a href="/"><i class="material-icons">home</i> Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('meeting.index')}}">Meetings List</a></li>
				<li class="breadcrumb-item active" aria-current="page">Add Meeting</li>
			</ol>
		</nav>
	</div>
	<div class="col-xl-8 col-md-12">
		<div class="ms-panel ms-panel-fh">
			<div class="ms-panel-header">
				<h6>Meeting Form</h6>
			</div>
			<div class="ms-panel-body">
				<form class="needs-validation clearfix" method="POST" action="{{route('meeting.update',$id)}}" novalidate>
					@csrf
					{{ method_field('PUT') }}
					<div class="form-row">
						<div class="col-xl-12 col-md-12 mb-3">
							<label for="name">Meeting Name</label>
							<div class="input-group">
								<input type="text" id="name" name="name" class="form-control" placeholder="Meeting Name" value="{{$meeting->name}}" required>
								<div class="invalid-feedback">
									Please Enter a Meeting Name.
								</div>
							</div>
						</div>
						<div class="col-xl-12 col-md-12 mb-3">
							<label for="description">Description</label>
							<div class="input-group">
								<textarea id="description" name="description" class="form-control" placeholder="Meeting Description" rows="3">{{$meeting->description}}</textarea>
								<div class="invalid-feedback">
									Please Enter Meeting Description.
								</div>
							</div>
						</div>
						<div class="col-xl-06 col-md-12 mb-3">
							<label for="date">Meeting Date</label>
							<div class="input-group">
								<input type="date" class="form-control" name="date" id="date" placeholder="Meeting Date" value="{{$meeting->date}}" required>
								<div class="invalid-feedback">
									Please Enter Meeting Date.
								</div>
							</div>
						</div>
						<div class="col-xl-06 col-md-12 mb-3">
							<label for="start">Start Time</label>
							<div class="input-group">
								<input type="time" class="form-control" name="start" id="start" placeholder="Start time" value="{{$meeting->start}}" required>
								<div class="invalid-feedback">
									Please Enter Start Time.
								</div>
							</div>
						</div>
						<div class="col-xl-06 col-md-12 mb-3">
							<label for="end">End Time</label>
							<div class="input-group">
								<input type="time" class="form-control" name="end" id="end" placeholder="End time" value="{{$meeting->end}}" required>
								<div class="invalid-feedback">
									Please Enter End Time.
								</div>
							</div>
						</div>	
						<div class="col-xl-12 col-md-12 mb-3">
							<label for="link">Meeting Link</label>
							<div class="input-group">
								<input type="url" id="link" name="link" class="form-control" placeholder="https://tegdarco.com" value="{{$meeting->link}}" required>
								<div class="invalid-feedback">
									Please Enter Meeting Link.
								</div>
							</div>
						</div>	
						<div class="col-xl-12 col-md-12 mb-3">
							<label for="participants">Select Participants</label>
							<select class="js-example-basic-multiple" name="users[]" multiple="multiple" style="width: 100%" required="">
								@foreach($users as $user)
								@if (in_array($user->id, $meeting->participants))
								<option value="{{ $user->id }}" selected="">{{$user->name }}</option>
								@else
								<option value="{{ $user->id }}">{{$user->name }}</option>
								@endif
								@endforeach
							</select>
							<div class="invalid-feedback">
								Please Select Participants.
							</div>	
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
<!-- Styles -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.js-example-basic-multiple').select2();
	});
</script>
@endpush