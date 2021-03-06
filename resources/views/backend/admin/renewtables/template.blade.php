@extends('layouts.app')
@section('head')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{asset('backend/assets/css/datatables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<nav aria-label="breadcrumb " class="ms-panel-custom">
			<ol class="breadcrumb pl-0">
				<li class="breadcrumb-item"><a href="/"><i class="material-icons">home</i> Home{{$selected_meal->table_id}}</a></li>
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
						<h5 class="pb-4">Diet Template - {{ $table }}</h5>
						<form class="needs-validation clearfix" method="POST" action="{{route('renew-table.update',$selected_meal->id)}}" novalidate="">
							@csrf
							{{ method_field('PUT') }}
							<div class="form-row">
								<div class="col-xl-3 col-md-12 mb-3">
									<label for="calories">Calories</label>
									<div class="input-group">
										<input type="text" class="form-control" id="calories" name="calories" placeholder="Calories" value="{{$selected_meal->calories}}"required="">
										<div class="invalid-feedback">
											Please provide Calories
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-md-12 mb-3">
									<label for="carbs">Carbs</label>
									<div class="input-group">
										<input type="text" class="form-control" id="carbs" name="carbs" placeholder="Carbs" value="{{$selected_meal->carbs}}"required="">
										<div class="invalid-feedback">
											Please provide Carbs
										</div>
									</div>
								</div>
								<br>
								<div class="col-xl-3 col-md-12 mb-3">
									<label for="carbs">Fat</label>
									<div class="input-group">
										<input type="text" class="form-control" id="fat" name="fat" placeholder="Fat"value="{{$selected_meal->fat}}" required="">
										<div class="invalid-feedback">
											Please provide Fat
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-md-12 mb-3">
									<label for="protein">Protein</label>
									<div class="input-group">
										<input type="text" class="form-control" id="protein" name="protein" placeholder="Protein" value="{{$selected_meal->protein}}"required="">
										<div class="invalid-feedback">
											Please provide Protein
										</div>
									</div>
								</div>
								<div class="col-xl-6 col-md-12 mb-3">
									<label for="breakfast">Select Breakfast</label>
									<div class="input-group">
										<select multiple="multiple" class="form-control js-example-basic-multiple" id="breakfast" name="breakfast[]" required="">
											@foreach($breakfasts as $breakfast)
											<option value="{{$breakfast->id}}" @if(in_array($breakfast->id,$selected_meal_breakfast)) selected @endif>{{$breakfast->food}}</option>
											@endforeach
										</select>
										<div class="invalid-feedback">
											Please Select Breakfast
										</div>
									</div>
								</div>
								<div class="col-xl-6 col-md-12 mb-3">
									<label for="snack1">Select Snacks</label>
									<div class="input-group">
										<select multiple="multiple" class="form-control js-example-basic-multiple" id="snack1" name="snack1[]" required="">
											@foreach($snacks as $snack)
											<option value="{{$snack->id}}" @if(in_array($snack->id,$selected_meal_snacks1)) selected @endif>{{$snack->food}}</option>
											@endforeach
										</select>
										<div class="invalid-feedback">
											Please Select Snack 1
										</div>
									</div>
								</div>
								<div class="col-xl-6 col-md-12 mb-3">
									<label for="lunch">Select Lunch</label>
									<div class="input-group">
										<select multiple="multiple" class="form-control js-example-basic-multiple" id="lunch" name="lunch[]" required="">
											@foreach($lunchs as $lunch)
											<option value="{{$lunch->id}}" @if(in_array($lunch->id,$selected_meal_lunch)) selected @endif>{{$lunch->food}}</option>
											@endforeach
										</select>
										<div class="invalid-feedback">
											Please Select Lunch
										</div>
									</div>
								</div>
								
								<div class="col-xl-6 col-md-12 mb-3">
									<label for="dinner">Select Dinner</label>
									<div class="input-group">
										<select multiple="multiple" class="form-control js-example-basic-multiple" id="dinner" name="dinner[]" required="">
											<option value="">Select Dinner</option>
											@foreach($dinners as $dinner)
											<option value="{{$dinner->id}}" @if(in_array($dinner->id,$selected_meal_dinner)) selected @endif>{{$dinner->food}}</option>
											@endforeach
										</select>
										<div class="invalid-feedback">
											Please Select Dinner
										</div>
									</div>
								</div>
								
								<div class="col-xl-6 col-md-12 mb-3">
									<div class="input-group">
										<input type="button" class="btn btn-light" name="calculate" value="Calculate Nutrients">
									</div>
								</div>
							</div>
							<div class="ms-panel-body float-right">
								<button type="button" class="btn btn-square btn-success has-icon"><i class="flaticon-tick-inside-circle"></i> Go to Chat</button>
								<button type="button" class="btn btn-square btn-danger has-icon" onclick="window.location.href='{{route('group-chat.index')}}'"><i class="flaticon-alert-1"></i> Consult Team</button>
								<input type="submit" class="btn btn-square btn-warning has-icon" name="submit" value="Send to Client"/>
							</div>
						</form>
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
	$("input[name='calculate']").on("click", function(){
		var breakfast = $('#breakfast :selected').val();
		var snack1 = $('#snack1 :selected').val();
		var lunch = $('#lunch :selected').val();
		var dinner = $('#dinner :selected').val();
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
				dinner: dinner,
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

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.js-example-basic-multiple').select2({
				tags: true,
				tokenSeparators: [',', ' ']
			});
		});
	</script>
@endpush
