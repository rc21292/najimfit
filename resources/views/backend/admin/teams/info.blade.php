@php 
$users = DB::table('users')->where('id','!=',Auth::User()->id)->where('id','!=',$user->id)->get();
@endphp
@extends('layouts.app')
@section('head')
<title>Dashboard|Teams</title>
@endsection
@section('content')
<div class="ms-panel">
	<div class="col-md-12">
		<div class="ms-panel-header">
			<div class="row">
				<div class="col-sm-3">
					<p><img class="rounded-circle" src='{{asset('backend/assets/img/avater.png')}}' style='width:55px; height:55px;'> {{$user->name}}</p>
				</div>
				<div class="col-sm-3 pt-3">
					<p>ID: NJMF{{$user->nutritionist_id}}</p>
				</div>
				<div class="col-sm-3 pt-3">
					<p>Email: {{$user->email}}</p>
				</div>
				<div class="col-sm-3 pt-3">
					<p>Joined Company: {{$user->created_at->diffForHumans()}}</p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 ms-inline">
			<div class="ms-panel-header">
				<nav aria-label="breadcrumb " class="ms-panel-custom">
					<h5>Nutritionist Performance</h5>
					<button type="button" class="btn btn-pill btn-success has-icon" data-toggle="modal" data-target="#exampleModal"><i class="flaticon-tick-inside-circle"></i> Defer All Clients</button>
					<a href="{{route('users.edit',$user->id)}}" class="btn btn-pill btn-danger has-icon"><i class="flaticon-alert-1"></i> Block Access</a>
					<a href="{{url('dashboard/staff-chats',$user->id)}}" class="btn btn-pill btn-warning has-icon"><i class="flaticon-alert"></i> Send Message</a>
				</nav>
			</div>
			<div class="ms-panel-body">
				<p class="ms-directions"></p>
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th scope="col">Total Clients</th>
								<th scope="col">{{ $total_clients }}</th>
							</tr>
						</thead>
						<thead>
							<tr>
								<th scope="col">Active Clients</th>
								<th scope="col">{{ $active_clients }}</th>
							</tr>
						</thead>
						<thead>
							<tr>
								<th scope="col">Pending Tables</th>
								<th scope="col">{{ $pending_tables }}</th>
							</tr>
						</thead>
						<thead>
							<tr>
								<th scope="col">Pending Workouts</th>
								<th scope="col">{{ $pending_workouts }}</th>
							</tr>
						</thead>
						<thead>
							<tr>
								<th scope="col">Renewal Tables</th>
								<th scope="col">{{ $renewal_table }}</th>
							</tr>
						</thead>
						<thead>
							<tr>
								<th scope="col">Renewal Workouts</th>
								<th scope="col">{{ $renewal_workout }}</th>
							</tr>
						</thead>
						<thead>
							<tr>
								<th scope="col">Total Complaints</th>
								<th scope="col">{{ $total_complaints }}</th>
							</tr>
						</thead>
						<thead>
							<tr>
								<th scope="col">Pending Complaints</th>
								<th scope="col">{{ $pending_complaints }}</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Defer Clients</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action="{{route('teams.update',$user->id)}}">
				@csrf
				{{ method_field('PUT') }}
				<div class="modal-body">
					<div class="form-group">
						<label for="message-text" class="col-form-label">Select Nutritionist:</label>
						<select class="form-control" id="message-text" name="defered_to">
							@foreach($users as $user)
							<option value="{{ $user->id }}">{{ $user->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
