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
	</div>
	<div class="col-md-12">
		<div class="ms-panel">
			<div class="ms-panel-header">
				<h6>Online Subscriptions:</h6>
			</div>
			<div class="ms-panel-body">
				<div class="row">
					<div class="col-sm-4">
						<b>Active subscriptions</b>: 2000<br>
						<b>Waiting list</b>: 250<br>
						<b>Average per nutritionist</b>: 2000<br>
					</div>
					<div class="col-sm-4">
						<b>Nutritionist 1</b>: 300<br>
						<b>Nutritionist 1</b>: 300<br>
						<b>Nutritionist 1</b>: 300<br>
					</div>
					<div class="col-sm-4">
						<b>Nutritionist 1</b>: 300<br>
						<b>Nutritionist 1</b>: 300<br>
						<b>Nutritionist 1</b>: 300<br>
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
						<b>Active subscriptions</b>: 2000<br>
						<b>Waiting list</b>: 250<br>
						<b>Average per nutritionist</b>: 2000<br>
					</div>
					<div class="col-sm-4">
						<b>Nutritionist 1</b>: 300<br>
						<b>Nutritionist 1</b>: 300<br>
						<b>Nutritionist 1</b>: 300<br>
					</div>
					<div class="col-sm-4">
						<b>Nutritionist 1</b>: 300<br>
						<b>Nutritionist 1</b>: 300<br>
						<b>Nutritionist 1</b>: 300<br>
					</div>
				</div>
				<br>
				<hr>
				<div class="row">
					<div class="col-sm-3">
					</div>
					<div class="col-sm-9">
						<a href="{{route('accept-subscriptions')}}" class='btn btn-primary btnpro'>Accept Subscriptions</a>
						<a href="{{route('close-subscriptions')}}" class='btn btn-success btnpro'>Close Subscriptions</a>
						<a href="{{route('cancel-subscription')}}" class='btn btn-danger btnpro'>Cancel Subscription</a>
						<a href="{{route('extension-subscription')}}" class='btn btn-info btnpro'>Extension</a> 
						<a href="{{route('block-subscription')}}" class='btn btn-primary btnpro'>Block Users</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
