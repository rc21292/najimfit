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
		<a href="{{ route('notifications.index') }}">
			<div class="ms-panel ms-widget ms-panel-hoverable has-border ms-has-new-msg ms-notification-widget">
				<div class="ms-panel-body media">
					<i class="fa fa-bell" aria-hidden="true"></i>
					<div class="media-body">
						<h6>Notifications</h6>
						<span></span>
					</div>
				</div>
			</div>
		</a>
	</div>
	<div class="col-xl-3 col-md-6">
		<a href="{{ route('subscriptions.index') }}">
			<div class="ms-panel ms-widget ms-panel-hoverable has-border ms-has-new-msg ms-notification-widget">
				<div class="ms-panel-body media">
					<i class="fa fa-bell" aria-hidden="true"></i>
					<div class="media-body">
						<h6>Subscriptions</h6>
						<span></span>
					</div>
				</div>
			</div>
		</a>
	</div>
	<div class="col-xl-3 col-md-6">
		<a href="{{ route('appointments.index') }}">
			<div class="ms-panel ms-widget ms-panel-hoverable has-border ms-has-new-msg ms-notification-widget">
				<div class="ms-panel-body media">
					<i class="fa fa-bell" aria-hidden="true"></i>
					<div class="media-body">
						<h6>Appointments</h6>
						<span></span>
					</div>
				</div>
			</div>
		</a>
	</div>
	<div class="col-xl-3 col-md-6">
		<a href="{{ route('teams.index') }}">
			<div class="ms-panel ms-widget ms-panel-hoverable has-border ms-has-new-msg ms-notification-widget">
				<div class="ms-panel-body media">
					<i class="fa fa-bell" aria-hidden="true"></i>
					<div class="media-body">
						<h6>Employees</h6>
						<span></span>
					</div>
				</div>
			</div>
		</a>
	</div>
	<div class="col-xl-3 col-md-6">
		<a href="{{ route('access.index') }}">
			<div class="ms-panel ms-widget ms-panel-hoverable has-border ms-has-new-msg ms-notification-widget">
				<div class="ms-panel-body media">
					<i class="fa fa-bell" aria-hidden="true"></i>
					<div class="media-body">
						<h6>Access</h6>
						<span></span>
					</div>
				</div>
			</div>
		</a>
	</div>
</div>
@endsection
@push('scripts')
@endpush