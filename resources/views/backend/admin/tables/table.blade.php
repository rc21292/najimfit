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
				<li class="breadcrumb-item"><a href="{{route('assign-table.index')}}">Nutritionist</a></li>
				<li class="breadcrumb-item"><a href="{{url()->previous()}}">Client List</a></li>
				<li class="breadcrumb-item active" aria-current="page">Assign Table</li>
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
							<h6>Select Table</h6>
							<div class="btn-group-toggle radiogrp" data-toggle="buttons">
								@foreach($tables as $table)
								@if(Session::get('table_id') == $table->id)
								<label class="btn btn-primary focus active">
									<input type="radio" name="table" class="diettable" value="{{ $table->id }}" checked="checked"> {{$table->name}}
									@else
									<label class="btn btn-primary">
										<input type="radio" name="table" class="diettable" value="{{ $table->id }}"> {{$table->name}}
										@endif
									</label>
									@endforeach
								</div>
							</div>
							<div class="pt-5">
								<h6>Select Calorie Range</h6>
								<div class="btn-group-toggle radiogrp" data-toggle="buttons">
									<label class="btn btn-secondary btnmax @if(Session::get('range') == '500-600 Cal') focus active @endif ml-4">
										<input type="radio" name="range" class="range" value="500-600 Cal" autocomplete="off" @if(Session::get('range') == "500-600 Cal") checked @endif> 500 - 600 Cal
									</label>
									<label class="btn btn-secondary btnmax @if(Session::get('range') == '600-700 Cal') focus active @endif ml-4">
										<input type="radio" name="range" class="range"  value="600-700 Cal"autocomplete="off" @if(Session::get('range') == "600-700 Cal") checked @endif> 600 - 700 Cal
									</label>
									<label class="btn btn-secondary btnmax @if(Session::get('range') == '700-800 Cal') focus active @endif ml-4">
										<input type="radio" name="range" class="range"  value="700-800 Cal"autocomplete="off" @if(Session::get('range') == "700-800 Cal") checked @endif> 700 - 800 Cal
									</label>
									<label class="btn btn-secondary btnmax @if(Session::get('range') == '800-900 Cal') focus active @endif ml-4">
										<input type="radio" name="range" class="range"  value="800-900 Cal"autocomplete="off" @if(Session::get('range') == "800-900 Cal") checked @endif> 800 - 900 Cal
									</label>

									<label class="btn btn-secondary btnmax @if(Session::get('range') == '900-1000 Cal') focus active @endif ml-4">
										<input type="radio" name="range" class="range"  value="900-1000 Cal"autocomplete="off" @if(Session::get('range') == "900-1000 Cal") checked @endif> 900 - 1000 Cal
									</label>

									<label class="btn btn-secondary btnmax @if(Session::get('range') == '1000-1100 Cal') focus active @endif ml-4">
										<input type="radio" name="range" class="range"  value="1000-1100 Cal"autocomplete="off" @if(Session::get('range') == "1000-1100 Cal") checked @endif> 1000 - 1100 Cal
									</label>
									<label class="btn btn-secondary btnmax @if(Session::get('range') == '1100-1200 Cal') focus active @endif ml-4">
										<input type="radio" name="range" class="range"  value="1100-1200 Cal"autocomplete="off" @if(Session::get('range') == "1100-1200 Cal") checked @endif> 1100 - 1200 Cal
									</label>
									<label class="btn btn-secondary btnmax @if(Session::get('range') == '1200-1300 Cal') focus active @endif ml-4">
										<input type="radio" name="range" class="range"  value="1200-1300 Cal"autocomplete="off" @if(Session::get('range') == "1100-1200 Cal") checked @endif> 1200 - 1300 Cal
									</label>
									<label class="btn btn-secondary btnmax @if(Session::get('range') == '1300-1400 Cal') focus active @endif ml-4">
										<input type="radio" name="range" class="range"  value="1300-1400 Cal"autocomplete="off" @if(Session::get('range') == "1300-1400 Cal") checked @endif> 1300 - 1400 Cal
									</label>
									<label class="btn btn-secondary btnmax @if(Session::get('range') == '1400-1500 Cal') focus active @endif ml-4">
										<input type="radio" name="range" class="range"  value="1400-1500 Cal"autocomplete="off" @if(Session::get('range') == "1400-1500 Cal") checked @endif> 1400 - 1500 Cal
									</label>
									<label class="btn btn-secondary btnmax @if(Session::get('range') == '1500-1600 Cal') focus active @endif ml-4">
										<input type="radio" name="range" class="range"  value="1500-1600 Cal"autocomplete="off" @if(Session::get('range') == "1500-1600 Cal") checked @endif> 1500 - 1600 Cal
									</label>
									<label class="btn btn-secondary btnmax @if(Session::get('range') == '1600-1700 Cal') focus active @endif ml-4">
										<input type="radio" name="range" class="range"  value="1600-1700 Cal"autocomplete="off" @if(Session::get('range') == "1600-1700 Cal") checked @endif> 1600 - 1700 Cal
									</label>
									<label class="btn btn-secondary btnmax @if(Session::get('range') == '1700-1800 Cal') focus active @endif ml-4">
										<input type="radio" name="range" class="range"  value="1700-1800 Cal"autocomplete="off" @if(Session::get('range') == "1700-1800 Cal") checked @endif> 1700 - 1800 Cal
									</label>
									<label class="btn btn-secondary btnmax @if(Session::get('range') == '1800-1900 Cal') focus active @endif ml-4">
										<input type="radio" name="range" class="range"  value="1800-1900 Cal"autocomplete="off" @if(Session::get('range') == "1800-1900 Cal") checked @endif> 1800 - 1900 Cal
									</label>
									<label class="btn btn-secondary btnmax @if(Session::get('range') == '1900-2000 Cal') focus active @endif ml-4">
										<input type="radio" name="range" class="range"  value="1900-2000 Cal"autocomplete="off" @if(Session::get('range') == "1900-2000 Cal") checked @endif> 1900 - 2000 Cal
									</label>
									<label class="btn btn-secondary btnmax @if(Session::get('range') == '2000-2100 Cal') focus active @endif ml-4">
										<input type="radio" name="range" class="range"  value="2000-2100 Cal"autocomplete="off" @if(Session::get('range') == "2000-2100 Cal") checked @endif> 2000 - 2100 Cal
									</label>
									<label class="btn btn-secondary btnmax @if(Session::get('range') == '2100-2200 Cal') focus active @endif ml-4">
										<input type="radio" name="range" class="range"  value="2100-2200 Cal"autocomplete="off" @if(Session::get('range') == "2100-2200 Cal") checked @endif> 2100 - 2200 Cal
									</label>
									<label class="btn btn-secondary btnmax @if(Session::get('range') == '2200-2300 Cal') focus active @endif ml-4">
										<input type="radio" name="range" class="range"  value="2200-2300 Cal"autocomplete="off" @if(Session::get('range') == "2200-2300 Cal") checked @endif> 2200 - 2300 Cal
									</label>
									<label class="btn btn-secondary btnmax @if(Session::get('range') == '2300-2400 Cal') focus active @endif ml-4">
										<input type="radio" name="range" class="range"  value="2300-2400 Cal"autocomplete="off" @if(Session::get('range') == "2300-2400 Cal") checked @endif> 2300 - 2400 Cal
									</label>
									<label class="btn btn-secondary btnmax @if(Session::get('range') == '2400-2500 Cal') focus active @endif ml-4">
										<input type="radio" name="range" class="range"  value="2400-2500 Cal"autocomplete="off" @if(Session::get('range') == "2400-2500 Cal") checked @endif> 2400 - 2500 Cal
									</label>
								</div>
							</div>

							<div class="ms-panel-body float-right">
								<button type="button" onclick="window.location.href='{{ route('client-chats.show',$client->id) }}' " class="btn btn-square btn-success has-icon"><i class="flaticon-tick-inside-circle"></i> Go to Chat</button>
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
				$('.range').change(function(e){
					e.preventDefault();
					var range = $(this).val()
					var table = $(".diettable:checked").val();
					var client_id = {{ $client->id }}
					if(table == null){
						alertify.set('notifier','position', 'top-center');
						alertify.error('Please Select Table');
					}else{
						$.ajaxSetup({
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							}
						});
						jQuery.ajax({
							url: "{{ route('set-table-session') }}",
							method: 'post',
							data: {
								range: range,
								table: table,
								client: client_id
							},
							success: function(result){
								window.location = '{{ route('diet-template') }}';
							}
						});
					}
				});
			});
		</script>
		@endpush