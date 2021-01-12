@extends('layouts.app')
@section('head')
<title>Dashboard|Teams</title>
@endsection
@section('content')
<div class="row">
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
@endsection
