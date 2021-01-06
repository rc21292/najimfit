@extends('layouts.app')
@section('head')
<link href="{{asset('backend/assets/css/datatables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		@include('backend.admin.includes.flashmessage')
	</div>
	<div class="col-xl-3 col-md-6">
		<a href="{{ route('clients-all') }}">
			<div class="ms-panel ms-widget ms-panel-hoverable has-border ms-has-new-msg ms-notification-widget">
				<span class="msg-count">{{ $total_clients }}</span>
				<div class="ms-panel-body media">
					<i class="fa fa-user" aria-hidden="true"></i>
					<div class="media-body">
						<h6>No. of Clients</h6>
						<span>{{ $total_clients }}</span>
					</div>
				</div>
			</div>
		</a>
	</div>
	<div class="col-xl-3 col-md-6">
		<a href="{{ route('renew-table-clients') }}">
			<div class="ms-panel ms-widget ms-panel-hoverable has-border ms-has-new-msg ms-notification-widget">
				<span class="msg-count">{{ $table_renewals }}</span>
				<div class="ms-panel-body media">
					<i class="fa fa-user" aria-hidden="true"></i>
					<div class="media-body">
						<h6>No. of Table Renewals</h6>
						<span>{{ $table_renewals }}</span>
					</div>
				</div>
			</div>
		</a>
	</div>

	<div class="col-xl-3 col-md-6">
		<a href="{{ route('renew-workout-clients') }}">
			<div class="ms-panel ms-widget ms-panel-hoverable has-border ms-has-new-msg ms-notification-widget">
				<span class="msg-count">{{ $workout_renewals }}</span>
				<div class="ms-panel-body media">
					<i class="fa fa-user" aria-hidden="true"></i>
					<div class="media-body">
						<h6>No. of Workout Renewals</h6>
						<span>{{ $workout_renewals }}</span>
					</div>
				</div>
			</div>
		</a>
	</div>

	<div class="col-xl-3 col-md-6">
		<a href="{{ route('new-clients') }}">
			<div class="ms-panel ms-widget ms-panel-hoverable has-border ms-has-new-msg ms-notification-widget">
				<span class="msg-count">{{ $clients_new }}</span>
				<div class="ms-panel-body media">
					<i class="fa fa-user" aria-hidden="true"></i>
					<div class="media-body">
						<h6>No. of New clients</h6>
						<span>{{ $clients_new }}</span>
					</div>
				</div>
			</div>
		</a>
	</div>
	<div class="col-xl-3 col-md-6">
		<a href="{{ route('older-clients') }}">
			<div class="ms-panel ms-widget ms-panel-hoverable has-border ms-has-new-msg ms-notification-widget">
				<span class="msg-count">{{ $clients_more_than_one_month }}</span>
				<div class="ms-panel-body media">
					<i class="fa fa-user" aria-hidden="true"></i>
					<div class="media-body">
						<h6>No. of Clients stay for more than one month</h6>
						<span>{{ $clients_more_than_one_month }}</span>
					</div>
				</div>
			</div>
		</a>
	</div>
	@foreach($packages as $package)
	<div class="col-xl-3 col-md-6">
		<a href="{{ route('clients-by-package',$package->package_id) }}">
			<div class="ms-panel ms-widget ms-panel-hoverable has-border ms-has-new-msg ms-notification-widget">
				<span class="msg-count">{{ $package->total }}</span>
				<div class="ms-panel-body media">
					<i class="fa fa-gift" aria-hidden="true"></i>
					<div class="media-body">
						<h6>No. of Clients in Package type <b>{{ $package->name }}</b></h6>
						<span>{{ $package->total }}</span>
					</div>
				</div>
			</div>
		</a>
	</div>
	@endforeach
	<div class="col-xl-3 col-md-6">
		<a href="{{ route('clients.index') }}">
			<div class="ms-panel ms-widget ms-panel-hoverable has-border ms-has-new-msg ms-notification-widget">
				<span class="msg-count">{{ $feedbacks }}</span>
				<div class="ms-panel-body media">
					<i class="fa fa-bell" aria-hidden="true"></i>
					<div class="media-body">
						<h6>Feedback from Clients</h6>
						<span>{{ $feedbacks }}</span>
					</div>
				</div>
			</div>
		</a>
	</div>
	
</div>
@endsection
@push('scripts')
@endpush