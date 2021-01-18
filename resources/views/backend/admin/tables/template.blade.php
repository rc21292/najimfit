@extends('layouts.app')
@section('head')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{asset('backend/assets/css/datatables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<style type="text/css">
	.select2-selection__choice:nth-child(odd) {
    margin-left : 20px !important;
}


</style>
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
						<h5 class="pb-4">Diet Template - {{ $table }}</h5>
						<form class="needs-validation clearfix" method="POST" action="{{route('assign-table.store')}}" novalidate="">
							@csrf
							<div class="form-row">
								<div class="col-xl-3 col-md-12 mb-3">
									<label for="calories">Calories</label>
									<div class="input-group">
										<input type="text" class="form-control" id="calories" name="calories" placeholder="Calories" required="">
										<div class="invalid-feedback">
											Please provide Calories
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-md-12 mb-3">
									<label for="carbs">Carbs</label>
									<div class="input-group">
										<input type="text" class="form-control" id="carbs" name="carbs" placeholder="Carbs" required="">
										<div class="invalid-feedback">
											Please provide Carbs
										</div>
									</div>
								</div>
								<br>
								<div class="col-xl-3 col-md-12 mb-3">
									<label for="carbs">Fat</label>
									<div class="input-group">
										<input type="text" class="form-control" id="fat" name="fat" placeholder="Fat" required="">
										<div class="invalid-feedback">
											Please provide Fat
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-md-12 mb-3">
									<label for="protein">Protein</label>
									<div class="input-group">
										<input type="text" class="form-control" id="protein" name="protein" placeholder="Protein" required="">
										<div class="invalid-feedback">
											Please provide Protein
										</div>
									</div>
								</div>
								<div class="col-xl-6 col-md-12 mb-3">
									<label for="breakfast">Select Breakfast</label>
									<div class="input-group">
										<select class="form-control js-example-basic-multiple" id="breakfast" multiple="multiple" name="breakfast[]" required="">
											<option value="">Select Breakfast</option>
											@foreach($breakfasts as $breakfast)
											<option value="{{$breakfast->id}}">{{$breakfast->food}}</option>
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
											<option value="">Select Snack 1</option>
											@foreach($snacks as $snack)
											<option value="{{$snack->id}}">{{$snack->food}}</option>
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
											<option value="">Select Lunch</option>
											@foreach($lunchs as $lunch)
											<option value="{{$lunch->id}}">{{$lunch->food}}</option>
											@endforeach
										</select>
										<div class="invalid-feedback">
											Please Select Lunch
										</div>
									</div>
								</div>
								{{-- <div class="col-xl-6 col-md-12 mb-3">
									<label for="snack2">Select Snack 2</label>
									<div class="input-group">
										<select multiple="multiple" class="form-control js-example-basic-multiple" id="snack2" name="snack2[]" style="display: none;">
											<option value="">Select Snack 2</option>
											@foreach($snacks as $snack)
											<option value="{{$snack->id}}">{{$snack->food}}</option>
											@endforeach
										</select>
										<div class="invalid-feedback">
											Please Select Snack 2
										</div>
									</div>
								</div> --}}
								<div class="col-xl-6 col-md-12 mb-3">
									<label for="dinner">Select Dinner</label>
									<div class="input-group">
										<select multiple="multiple" class="form-control js-example-basic-multiple" id="dinner" name="dinner[]" required="">
											<option value="">Select Dinner</option>
											@foreach($dinners as $dinner)
											<option value="{{$dinner->id}}">{{$dinner->food}}</option>
											@endforeach
										</select>
										<div class="invalid-feedback">
											Please Select Dinner
										</div>
									</div>
								</div>
								{{-- <div class="col-xl-6 col-md-12 mb-3">
									<label for="snack3">Select Snack 3</label>
									<div class="input-group">
										<select multiple="multiple" class="form-control js-example-basic-multiple" id="snack3" name="snack3[]" style="display: none;">
											<option value="">Select Snack 3</option>
											@foreach($snacks as $snack)
											<option  value="{{$snack->id}}">{{$snack->food}}</option>
											@endforeach
										</select>
										<div class="invalid-feedback">
											Please Select Snack 3
										</div>
									</div>
								</div> --}}
								<div class="col-xl-6 col-md-12 mb-3">
									<div class="input-group">
										<input type="button" class="btn btn-light" name="calculate" value="Calculate Nutrients">
									</div>
								</div>
							</div>
							<div class="ms-panel-body float-right">
								<button type="button" class="btn btn-square btn-success has-icon"><i class="flaticon-tick-inside-circle"></i> Go to Chat</button>
								<button type="button" class="btn btn-square btn-danger has-icon"><i class="flaticon-alert-1"></i> Consult Team</button>
								<input type="submit" class="btn btn-square btn-warning has-icon" name="submit" value="Send to Client"/>
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

	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.js-example-basic-multiple').select2({
				tags: true,
				tokenSeparators: [',', ' ']
			});
		});
	</script>

	<script type="text/javascript">
		$("input[name='calculate']").on("click", function(){
			/*var snack3=[];
			$('#snack3 :selected').each(function(){
				snack3.push($(this).val());
			});*/
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
	@endpush
