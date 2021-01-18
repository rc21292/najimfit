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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

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
								<form method="post" action="{{route('renew-workout.store')}}">
									@csrf
									<input type="hidden" name="client_id" value="{{ $client->id }}">
									<div class="col-xl-12 col-md-12">
										<div class="ms-panel ms-panel-fh">
											<div class="ms-panel-header">
												<h6>Day Wise Workout Table</h6>
											</div>
											<div class="ms-panel-body">
												<div class="table">
													<table id="days" class="table thead-primary">
														<thead>
															<tr>
																<th scope="col">Day :ex(1,2)</th>
																<th scope="col">Select Exrecises</th>
																<th scope="col">Add Days</th>

															</tr>
														</thead>
														@php

														$days_row = 0;

														$day_wise_exercises = DB::table('client_workouts')
														->join('exercises','exercises.id','=','client_workouts.exercise')
														->select('exercises.id as exercise_id','exercises.name','client_workouts.day','client_workouts.exercise')
														->where('client_workouts.client_id',$client->id)
														->orderBy('day')
														->groupBy('day')
														->get();

														@endphp

														<tbody>
															@foreach($day_wise_exercises as $day_wise_exercise)
															<tr id="day-row{{ $days_row }}">
																<td class="text-right"><input type="text" name="days[{{$day_wise_exercise->day}}][day]" placeholder="" class="form-control" value="{{ $day_wise_exercise->day }}"/></td>
																<td class="text-right" >
																	<select name="days[{{$day_wise_exercise->day}}][exercises][]" value="" placeholder="Exercise Name" class="exercises form-control" required multiple="multiple">
																		@foreach($exercises as $exercise)
																		@if($day_wise_exercise->exercise == $exercise->id)
																		<option value="{{$exercise->id}}" selected>{{$exercise->name}}</option>
																		@else
																		<option value="{{$exercise->id}}">{{$exercise->name}}</option>
																		@endif
																		@endforeach
																	</select>
																</td>
																<td class="text-center"><button type="button" onclick="$('#day-row{{ $days_row  }}').remove();" data-toggle="tooltip" title="remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
															</tr>
															@php
															$days_row ++;
															@endphp
															@endforeach
														</tbody>
														<tfoot>
															<tr>
																<th scope="row"></th>
																<td></td>
																<td class="text-center"><button type="button" onclick="adddays();" data-toggle="tooltip" title="Add Option Value" class="btn btn-danger"><i class="fa fa-plus"></i></button></td></td>
															</tr>
														</tfoot>
													</table>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<button class="btn btn-primary float-right" type="submit">Save</button>
										</div>

									</div>
								</form>
							</div>

							<div class="ms-panel-body float-right">
								<button type="button" class="btn btn-square btn-success has-icon"><i class="flaticon-tick-inside-circle"></i> Go to Chat</button>
								<button type="button" class="btn btn-square btn-danger has-icon" onclick="window.location.href='{{route('group-chat.index')}}'"><i class="flaticon-alert-1"></i> Consult Team</button>
							</div>
						</div>

						<div class="col-sm-3" style="border: 1px dotted #00ff08;">
							<h5 class="text-center pb-3">Questionnaire</h5>
							@forelse($answers as $answer)
							<p>Q: {{ $answer->question }} </p>
							<p>A: {{ $answer->answer }} </p>
							@empty
							<p class="text-center"><strong>Not Answered</strong></p>

							@endforelse
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
			});
		});
	</script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

	<script type="text/javascript">
		var days_row = 0;
		function adddays() {
			html = '<tr id="day-row' + days_row + '">';
			html += '  <th scope="row"><input type="text" name="days[' + days_row + '][day]" value="" placeholder="Day" class="form-control col-sm-3" required/></td>';
			html += '  <td class="text-right"><select name="days[' + days_row + '][exercises][]" value="" placeholder="Exercise Name" class="exercises form-control" required multiple="multiple">@foreach($exercises as $exercise)<option value="{{$exercise->id}}">{{$exercise->name}}</option>@endforeach</select></td>';
			html += '  <td class="text-center"><button type="button" onclick="$(\'#day-row' + days_row + '\').remove();" data-toggle="tooltip" title="remove" class="ms-btn-icon btn-square btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
			html += '</tr>';

			$('#days tbody').append(html);
			$('.exercises').select2();
			days_row++;
		}           

	</script>
	<script type="text/javascript"><!--
		var facility_row = 0;

		function addImage() {
			html = '<tr id="facility-row' + facility_row + '">';
			html += '  <td class="text-right"><input type="text" name="facility[' + facility_row + '][facility_val]" value="" placeholder="Sub value" class="form-control" /></td>';
			html += '  <td class="text-center"><button type="button" onclick="$(\'#facility-row' + facility_row + '\').remove();" data-toggle="tooltip" title="remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
			html += '</tr>';

			$('#facilities tbody').append(html);

			facility_row++;
		}

		//--></script>
		<script type="text/javascript">$('.exercises').select2();</script>


		@endpush