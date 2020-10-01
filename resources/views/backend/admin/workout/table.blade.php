@extends('layouts.app')
@section('head')
<link href="{{asset('backend/assets/css/datatables.min.css')}}" rel="stylesheet">
<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/alertify.min.js"></script>
<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/css/themes/bootstrap.min.css"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<nav aria-label="breadcrumb " class="ms-panel-custom">
			<ol class="breadcrumb pl-0">
				<li class="breadcrumb-item"><a href="/"><i class="material-icons">home</i> Home</a></li>
				<li class="breadcrumb-item"><a href="{{route('assign-workout.index')}}">Nutritionist</a></li>
				<li class="breadcrumb-item"><a href="{{url()->previous()}}">Client List</a></li>
				<li class="breadcrumb-item active" aria-current="page">Assign Workout</li>
			</ol>
			<a href="{{ url()->previous() }}" class="ms-btn-icon btn-square btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i></a>
		</nav>
		@include('backend.admin.includes.flashmessage')
	</div>
	<div class="col-md-12">
		<div class="ms-panel">
			<div class="ms-panel-header">
				<div class="row">
					<div class="col-sm-2">
						<p><img class="rounded-circle" src='https://via.placeholder.com/55x55' style='width:55px; height:55px;'> {{$client->firstname}} {{$client->lastname}}</p>
					</div>
					<div class="col-sm-2 pt-3">
						<p>ID: NJMF{{$client->id}}</p>
					</div>
					<div class="col-sm-2 pt-3">
						<p>Gender: {{ucfirst($client->gender)}}</p>
					</div>
					<div class="col-sm-2 pt-3">
						<p>Age: 26 Years</p>
					</div>
					<div class="col-sm-2 pt-3">
						<p>Weight: {{ $weight }}</p>
					</div>
					<div class="col-sm-2 pt-3">
						<p>Height: {{ $height }}</p>
					</div>
				</div>
			</div>
			<div class="ms-panel-body">
				<div class="row">
					<div class="col-sm-9">
						<div class="table-responsive">
							<h6>Select Workout Category</h6>
							<div class="btn-group-toggle radiogrp" data-toggle="buttons">
								@foreach($workouts as $workout)
								@if(Session::get('workout_id') == $workout->id)
								<label class="btn btn-primary focus active">
									<input type="radio" name="workout" class="dietworkout" value="{{ $workout->id }}" checked="checked"> {{$workout->name}}
									@else
									<label class="btn btn-primary">
										<input type="radio" name="workout" class="dietworkout" value="{{ $workout->id }}"> {{$workout->name}}
										@endif
									</label>
									@endforeach
								</div>
							</div>
							<div class="pt-5 workoutdiv" style="display: none;">
								<h6>Select Exercise</h6>
								<div class="col-xl-4 col-md-12">
									<label for="Exercise">Exercise</label>
									<div class="input-group">
										<select class="form-control"  name="exercise" id="exercise" required="">
											@foreach($exercises as $exercise)
											<option value="">01</option>
											@endforeach
										</select>
										<div class="invalid-feedback">
											Please select a Exercise.
										</div>
									</div>
								</div>
							</div>

							<div class="ms-panel-body float-right">
								<button type="button" class="btn btn-square btn-success has-icon"><i class="flaticon-tick-inside-circle"></i> Go to Chat</button>
								<button type="button" class="btn btn-square btn-danger has-icon"><i class="flaticon-alert-1"></i> Consult Team</button>
							</div>
						</div>

						<div class="col-sm-3" style="border: 1px dotted #00ff08;">
							<h5 class="text-center pb-3">Questionnaire</h5>
							@foreach($answers as $answer)
							<p>Q: {{ $answer->question }} <p>
								<p>A: {{ $answer->answer }} </p>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endsection
		@push('scripts')
		<script type="text/javascript">
			$( document ).ready(function() {
				$('.dietworkout').change(function(e){
					e.preventDefault();
					var workout = $(this).val()
					var client_id = {{ $client->id }}
					$('.workoutdiv').show();
					// if(table == null){
					// 	alertify.set('notifier','position', 'top-center');
					// 	alertify.error('Please Select Workout');
					// }else{
					// 	$.ajaxSetup({
					// 		headers: {
					// 			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					// 		}
					// 	});
					// 	jQuery.ajax({
					// 		url: "{{ route('set-workout-session') }}",
					// 		method: 'post',
					// 		data: {
					// 			range: range,
					// 			table: table,
					// 			client: client_id
					// 		},
					// 		success: function(result){
					// 			window.location = '{{ route('workout-template') }}';
					// 		}
					// 	});
					// }
				});
			});
		</script>
		<a
		@endpush