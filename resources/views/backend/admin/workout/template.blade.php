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
				<li class="breadcrumb-item active" aria-current="page">Diet template</li>
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
					<div class="col-md-9">
						<form class="needs-validation clearfix" method="POST" action="" novalidate="">
							@csrf
							<div class="ms-panel ms-panel-fh">
								<div class="ms-panel-header">
									<div class="row">
										<div class="col-sm-9">
											<h6>Select Reps and Sets</h6>
										</div>
										<div class="col-sm-3">
											<a href="{{route('assign-workout.edit',$client->id)}}" class="btn btn-info has-icon"><i class="flaticon-information"></i>Add Exercises</a>
										</div>
									</div>
								</div>
								<div class="ms-panel-body">
									<ul class="nav nav-tabs tabs-bordered d-flex nav-justified mb-4" role="tablist">
										@php
										$no_control=1;
										@endphp
										@for ($i = 0; $i < $no_days; $i++)
										<li role="presentation"><a href="#tab{{$no_control}}" @if($no_control==1)class="active show" @endif aria-controls="tab1"  role="tab" data-toggle="tab" aria-selected="false"> Day {{$no_control}} </a></li>
										@php
										$no_control++;
										@endphp
										@endfor
									</ul>
									<div class="tab-content">
										<form id="workout" method="POST" action="{{route('assign-workout-template')}}">
											@csrf
											
											@php
											$no_tab=1;
											@endphp
											@for ($i = 0; $i < $no_days; $i++)
											<div role="tabpanel" @if($no_tab == 1) class="tab-pane active show fade in" @else class="tab-pane fade in" @endif  id="tab{{$no_tab}}">
												<div class="ms-panel">
													<div class="ms-panel-header">
														<h6>Day {{$no_tab}}</h6>
													</div>
													<div class="ms-panel-body">
														<div class="table-responsive">
															<table class="table table-hover thead-primary">
																<thead>
																	<tr>
																		<th scope="col">Exercise</th>
																		<th scope="col">Sets</th>
																		<th scope="col">Reps</th>
																		<th scope="col">Action</th>
																	</tr>
																</thead>
																<tbody>
																	@foreach($workouts as $workout)
																	@if($workout->day == $no_tab)
																	<tr>
																		<td><a href="{{route('workout-info',$workout->exercise)}}" disabled class="btn btn-pill btn-light" style="margin: auto">{{$workout->name}}</a></td>
																		<td><input type="number" name="day[{{$no_tab}}]sets" class="form-control" required></td>
																		<td><input type="number" name="day[{{$no_tab}}]reps" class="form-control" required></td>
																		{{-- <td><a href="javascript:" onclick="submitform(2);"><i class="far fa-trash-alt ms-text-danger"></i></a><form id="delete-form2" action="{{route('assign-workout.destroy',$workout->id)}}" method="POST"><input type='hidden' name='_token' value='{{ csrf_token()}}'><input type='hidden' name='_method' value='DELETE'></form></td> --}}
																	</tr>
																	@endif
																	@endforeach
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
										@php
										$no_tab++;
										@endphp
										@endfor
																</form>
									</div>
								</div>
							</div>
							<div class="ms-panel-body float-right">
								<button type="button" class="btn btn-square btn-success has-icon"><i class="flaticon-tick-inside-circle"></i> Go to Chat</button>
								<button type="button" class="btn btn-square btn-danger has-icon"><i class="flaticon-alert-1"></i> Consult Team</button>
								<input type="submit" class="btn btn-square btn-warning has-icon" name="submit" form="workout" value="Send to Client"/>
							</div>
						</form>
					</div>
					<div class="col-md-3" style="border: 1px dotted #00ff08;">
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
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript">
		$("input[name='calculate']").on("click", function(){
			var breakfast = $('#breakfast :selected').val();
			var snack1 = $('#snack1 :selected').val();
			var lunch = $('#lunch :selected').val();
			var snack2 = $('#snack2 :selected').val();
			var dinner = $('#dinner :selected').val();
			var snack3 = $('#snack3 :selected').val();
			$.ajaxSetup({

				headers: {

					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

				}

			});

			jQuery.ajax({
				url: "{{ route('food-info') }}",
				method: 'post',
				data: {
					breakfast: breakfast,
					snack1: snack1,
					lunch: lunch,
					snack2: snack2,
					dinner: dinner,
					snack3: snack3
				},
				success: function(result){
					$('#calories').val(result.calories);
					$('#carbs').val(result.carbs);
					$('#fat').val(result.fat);
					$('#protein').val(result.protein);
				}
			});
		});
	</script>
	<script type="text/javascript">
		function submitform(no){
			swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this!",
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
