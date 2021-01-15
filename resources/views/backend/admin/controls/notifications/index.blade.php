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
				<li class="breadcrumb-item active" aria-current="page">Notifications</li>
			</ol>
			<a href="{{ URL::previous() }}" class="ms-btn-icon btn-square btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i></a>		</nav>
		@include('backend.admin.includes.flashmessage')
	</div>
	<div class="col-md-12">
		<div class="ms-panel">
			<hr>
			<div class="ms-panel-header">
				<h6>Notifications:</h6>
			</div>
			<div class="ms-panel-body">
				<div class="row">
					<div class="col-sm-2">
					</div>
					<div class="col-sm-9">
						<a href="{{route('send-push-notification')}}" class='btn btn-primary btnpro'>Send general push notification</a>
						<a href="{{route('send-personalized-push-notification')}}" class='btn btn-primary btnpro'>Send personalized push notification</a>
						<a href="{{route('notifications-history')}}" class='btn btn-danger btnpro'>Notifications History</a>
					</div>
				</div>
			</div>
			<hr>
			<div class="ms-panel-header">
				<h6>Broadcasts:</h6>
			</div>
			<div class="ms-panel-body">
				<div class="row">
					<div class="col-sm-2">
					</div>
					<div class="col-sm-9">
						<a href="{{route('send-in-chat-broadcast')}}" class='btn btn-success btnpro'>Send general in-chat broadcast</a>
						<a href="{{route('send-personalized-in-chat-broadcast')}}" class='btn btn-success btnpro'>Send personalized in-chat broadcast</a>

						<a href="{{route('broadcasts-history')}}" class='btn btn-info btnpro'>Broadcasts History</a> 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
