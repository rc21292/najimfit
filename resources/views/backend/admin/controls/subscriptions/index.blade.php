@extends('layouts.app')
@section('head')
<link href="{{asset('backend/assets/css/datatables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<nav aria-label="breadcrumb " class="ms-panel-custom">
			<ol class="breadcrumb pl-0">
				<li class="breadcrumb-item"><a href="/dashboard"><i class="material-icons">home</i> Home</a></li>
				<li class="breadcrumb-item"><a href="/dashboard/controls"><i class="fa fa-cogs"></i>Controls</a></li>
				<li class="breadcrumb-item active" aria-current="page">Subscription</li>
			</ol>
			<a href="{{ URL::previous() }}" class="ms-btn-icon btn-square btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i></a>		</nav>
		@include('backend.admin.includes.flashmessage')
		@if($subscription_settings->accept_subscriptions)
					<div class="alert alert-info" role="alert">
						<i class="flaticon-information"></i> <strong>Heads up!</strong> Suscription are accepting now, you can close subscriptions by clicking on Accept Subscriptions button.
					</div>
					@else
					<div class="alert alert-info" role="alert">
						<i class="flaticon-information"></i> <strong>Heads up!</strong> Suscription are closed now, you can accept subscriptions by clicking on Close Subscriptions button.
					</div>
					@endif
	</div>
	<div class="col-md-12">
		<div class="ms-panel">
			<div class="ms-panel-header">
				<h6>Online Subscriptions:</h6>
			</div>
			<div class="ms-panel-body">
				<div class="row">
					<div class="col-sm-4">
						<b>Active subscriptions</b>: {{$online_active_subscriptions}}<br>
						<b>Waiting list</b>: {{$waiting_subscriptions}}<br>
						<b>Average per nutritionist</b>: {{$average_per_nutritionist}}<br>
					</div>
					<div class="col-sm-4">
						@php $count = 1; @endphp
						@foreach($subscriptions_by_nutritionists as $subscriptions_by_nutritionist)
						@if($count >= round($subscriptions_by_nutritionists_total/2))
						<!-- </div>
					<div class="col-sm-4"> -->
						@endif
						<b> {{$subscriptions_by_nutritionist->name}} </b>: {{$subscriptions_by_nutritionist->total}}
						 @if($count != round($subscriptions_by_nutritionists_total))<br> @endif
						@php $count++ @endphp
						@endforeach					
					</div>
				</div>
			</div>
			<hr>
			<div class="ms-panel-header">
				<h6>Center Subscriptions:</h6>
			</div>
			<div class="ms-panel-body">
				<div class="row">
					<div class="col-sm-4">
						<b>Active subscriptions</b>: {{$active_subscriptions}}<br>
						<b>Waiting list</b>: {{$active_waiting_subscriptions}}<br>
						<b>Average per nutritionist</b>: {{$active_average_per_nutritionist}}<br>
					</div>
					<div class="col-sm-4">
						@php $count = 1; @endphp
						@foreach($active_subscriptions_by_nutritionists as $subscriptions_by_nutritionist)
						@if($count >= round($subscriptions_by_nutritionists_total/2))
						<!-- </div>
					<div class="col-sm-4"> -->
						@endif
						<b> {{$subscriptions_by_nutritionist->name}} </b>: {{$subscriptions_by_nutritionist->total}}
						 @if($count != round($subscriptions_by_nutritionists_total))<br> @endif
						@php $count++ @endphp
						@endforeach					
					</div>
				</div>
				<hr>
				<form  method="POST" action="{{route('update-suscription-settings')}}" novalidate>
					<div class="row">
						@csrf
						{{method_field('post')}}
						<div class="col-sm-3">
							<label for="carbs">Subscriptions Limit</label>
							<div class="input-group">
								<input type="number" class="form-control" name="subscriptions_limit" id="carbs" placeholder="Subscriptions Limit" value="{{$subscription_settings->subscriptions_limit}}" required>
								<div class="invalid-feedback">
									Please provide Subscriptions Limit.
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<label for="fat">Subscriptions Wating List Limit</label>
							<div class="input-group">
								<input type="number" class="form-control" name="subscriptions_watinglist_limit" id="fat" placeholder="Subscriptions Wating List Limit" value="{{$subscription_settings->subscriptions_watinglist_limit}}" required>
								<div class="invalid-feedback">
									Please provide Subscriptions Wating List Limit.
								</div>
							</div>
						</div>	
						<div class="col-sm-4">
							<button class="btn btn-primary mt-4" type="submit">Save</button>
						</div>
					</div>
				</form>
				<hr>
				<div class="row">
					<div class="col-sm-12">
						@if($subscription_settings->accept_subscriptions)
						<a style="margin-top:5px;" href="javascript:void(0)" class='btn btn-primary btnpro'>Accept Subscriptions</a>
						@else
						<a style="margin-top:5px;" href="{{route('accept-subscriptions')}}" class='btn btn-primary btnpro'>Accept Subscriptions</a>
						@endif
						@if($subscription_settings->close_subscriptions)
						<a style="margin-top:5px;" href="javascript:void(0)" class='btn btn-success btnpro'>Close Subscriptions</a>
						@else
						<a style="margin-top:5px;" href="{{route('close-subscriptions')}}" class='btn btn-success btnpro'>Close Subscriptions</a>
						@endif
						<a style="margin-top:5px;" href="{{route('cancel-subscription')}}" class='btn btn-danger btnpro'>Cancel Subscription</a>
						<a style="margin-top:5px;" href="{{route('extend-subscription')}}" class='btn btn-info btnpro'>Extend Subscriptions</a> 
						<a style="margin-top:5px;" href="{{route('block-user')}}" class='btn btn-primary btnpro'>Block Users from App</a>
						<a style="margin-top:5px;" href="{{route('custom-messages')}}" class='btn btn-primary btnpro'>Custom Messages</a>
						<a style="margin-top:5px;" href="{{route('notify-clients')}}" class='btn btn-primary btnpro'>Notify clients</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
