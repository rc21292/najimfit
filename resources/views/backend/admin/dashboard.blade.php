@extends('layouts.app')
@section('head')
<title>Admin |Dashboard</title>
@endsection
@section('content')
<div class="row">
	<div class="col-xl-3 col-md-6">
		<div class="ms-card card-gradient-success ms-widget ms-infographics-widget">
			<div class="ms-card-body media">
				<div class="media-body">
					<h6>Chats</h6>
					<p class="ms-card-change"> <i class="material-icons">arrow_upward</i> 4567</p>
					<p class="fs-12">48% From Last 24 Hours</p>
				</div>
			</div>
			<i class="fab fa-stack-exchange"></i>
		</div>
	</div>

	<div class="col-xl-3 col-md-6">
		<div class="ms-card card-gradient-secondary ms-widget ms-infographics-widget">
			<div class="ms-card-body media">
				<div class="media-body">
					<h6>Due tables</h6>
					<p class="ms-card-change"> $80,950</p>
					<p class="fs-12">2% Decreased from last day</p>
				</div>
			</div>
			<i class="fa fa-table"></i>
		</div>
	</div>

	<div class="col-xl-3 col-md-6">
		<div class="ms-card card-gradient-warning ms-widget ms-infographics-widget">
			<div class="ms-card-body media">
				<div class="media-body">
					<h6>Renewals </h6>
					<p class="ms-card-change">4567</p>
					<p class="fs-12">48% From Last 24 Hours</p>
				</div>
			</div>
			<i class="fa fa-redo"></i>
		</div>
	</div>

	<div class="col-xl-3 col-md-6">
		<div class="ms-card card-gradient-info ms-widget ms-infographics-widget">
			<div class="ms-card-body pos media">
				<div class="media-body">
					<h6>Clients</h6>
					<p class="ms-card-change"> $80,950</p>
					<p class="fs-12">2% Decreased from last week</p>
				</div>
			</div>
			<i class="far fa-user-circle"></i>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xl-3 col-md-6">
		<div class="ms-card card-gradient-secondary ms-widget ms-infographics-widget">
			<div class="ms-card-body media">
				<div class="media-body">
					<h6>Staff Chats</h6>
					<p class="ms-card-change"> <i class="material-icons">arrow_upward</i> 4567</p>
					<p class="fs-12">48% From Last 24 Hours</p>
				</div>
			</div>
			<i class="fab fa-teamspeak"></i>
		</div>
	</div>

	<div class="col-xl-3 col-md-6">
		<div class="ms-card card-gradient-success ms-widget ms-infographics-widget">
			<div class="ms-card-body media">
				<div class="media-body">
					<h6>Due Workouts</h6>
					<p class="ms-card-change"> $80,950</p>
					<p class="fs-12">2% Decreased from last day</p>
				</div>
			</div>
			<i class="fa fa-burn"></i>
		</div>
	</div>

	<div class="col-xl-3 col-md-6">
		<div class="ms-card card-gradient-secondary ms-widget ms-infographics-widget">
			<div class="ms-card-body media">
				<div class="media-body">
					<h6>Renewed Workouts</h6>
					<p class="ms-card-change"> <i class="material-icons">arrow_upward</i> 4567</p>
					<p class="fs-12">48% From Last 24 Hours</p>
				</div>
			</div>
			<i class="fa fa-sync"></i>
		</div>
	</div>

	<div class="col-xl-3 col-md-6">
		<div class="ms-card card-gradient-warning ms-widget ms-infographics-widget">
			<div class="ms-card-body pos media">
				<div class="media-body">
					<h6>Requests</h6>
					<p class="ms-card-change"> $80,950</p>
					<p class="fs-12">2% Decreased from last week</p>
				</div>
			</div>
			<i class="fa fa-anchor"></i>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xl-3 col-md-6">
		<div class="ms-card card-gradient-success ms-widget ms-infographics-widget">
			<div class="ms-card-body media">
				<div class="media-body">
					<h6>Complaints</h6>
					<p class="ms-card-change"> <i class="material-icons">arrow_upward</i> 4567</p>
					<p class="fs-12">48% From Last 24 Hours</p>
				</div>
			</div>
			<i class="fas fa-exclamation-triangle"></i>
		</div>
	</div>

	<div class="col-xl-3 col-md-6">
		<div class="ms-card card-gradient-secondary ms-widget ms-infographics-widget">
			<div class="ms-card-body media">
				<div class="media-body">
					<h6>Controls</h6>
					<p class="ms-card-change"> $80,950</p>
					<p class="fs-12">2% Decreased from last day</p>
				</div>
			</div>
			<i class="fa fa-cogs"></i>
		</div>
	</div>

	<div class="col-xl-3 col-md-6">
		<div class="ms-card card-gradient-warning ms-widget ms-infographics-widget">
			<div class="ms-card-body media">
				<div class="media-body">
					<h6>Data </h6>
					<p class="ms-card-change"> <i class="material-icons">arrow_upward</i> 4567</p>
					<p class="fs-12">48% From Last 24 Hours</p>
				</div>
			</div>
			<i class="fa fa-database"></i>
		</div>
	</div>

	<div class="col-xl-3 col-md-6">
		<div class="ms-card card-gradient-info ms-widget ms-infographics-widget">
			<div class="ms-card-body pos media">
				<div class="media-body">
					<h6>Teams</h6>
					<p class="ms-card-change"> $80,950</p>
					<p class="fs-12">2% Decreased from last week</p>
				</div>
			</div>
			<i class="fas fa-users"></i>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xl-3 col-md-6">
		<div class="ms-card card-gradient-secondary ms-widget ms-infographics-widget">
			<div class="ms-card-body media">
				<div class="media-body">
					<h6>Share & Meetings</h6>
					<p class="ms-card-change"> <i class="material-icons">arrow_upward</i> 4567</p>
					<p class="fs-12">48% From Last 24 Hours</p>
				</div>
			</div>
			<i class="fa fa-handshake"></i>
		</div>
	</div>

	<div class="col-xl-3 col-md-6">
		<div class="ms-card card-gradient-success ms-widget ms-infographics-widget">
			<div class="ms-card-body media">
				<div class="media-body">
					<h6>Calender</h6>
					<p class="ms-card-change"> $80,950</p>
					<p class="fs-12">2% Decreased from last day</p>
				</div>
			</div>
			<i class="fa fa-calendar"></i>
		</div>
	</div>

	<div class="col-xl-3 col-md-6">
		<div class="ms-card card-gradient-secondary ms-widget ms-infographics-widget">
			<div class="ms-card-body media">
				<div class="media-body">
					<h6>Notes</h6>
					<p class="ms-card-change"> <i class="material-icons">arrow_upward</i> 4567</p>
					<p class="fs-12">48% From Last 24 Hours</p>
				</div>
			</div>
			<i class="far fa-clipboard"></i>
		</div>
	</div>

	<div class="col-xl-3 col-md-6">
		<div class="ms-card card-gradient-warning ms-widget ms-infographics-widget">
			<div class="ms-card-body pos media">
				<div class="media-body">
					<h6>My Profile</h6>
					<p class="ms-card-change"> $80,950</p>
					<p class="fs-12">2% Decreased from last week</p>
				</div>
			</div>
			<i class="fas fa-id-card"></i>
		</div>
	</div>
</div>
@endsection
@push('scripts')

@endpush