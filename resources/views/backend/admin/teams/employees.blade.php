@extends('layouts.app')
@section('head')
<title>Dashboard|Teams</title>
@endsection
@section('content')
<div class="col-xl-12 col-md-12">
  @if($role_name == 'Nutritionist')
  <div class="ms-panel">
    <div class="ms-panel-header">
      <h6>All Nutritionists</h6>
    </div>
    <div class="ms-panel-body">
      <p class="ms-directions"></p>
      <div class="table-responsive">
        <table class="table table-hover thead-primary">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nutritionist</th>
              <th scope="col">Active Clients</th>
              <th scope="col">Pending Tables</th>
              <th scope="col">Pending Workouts</th>
              <th scope="col">Renewal Tables</th>
              <th scope="col">Renewal Workouts</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            @php
            $active_clients = DB::table('nutritionist_clients')->where('nutritionist_id',$user->id)->count();
            $posted_tables = DB::table('nutritionist_clients')->where('nutritionist_id',$user->id)->where('table_status','due')->count();
            $posted_workouts = DB::table('nutritionist_clients')->where('nutritionist_id',$user->id)->where('workout_status','due')->count();
            $renewal_table = DB::table('nutritionist_clients')->where('nutritionist_id',$user->id)->where('table_status','posted')->count();
            $renewal_workout = DB::table('nutritionist_clients')->where('nutritionist_id',$user->id)->where('workout_status','posted')->count();
            @endphp
            <tr>
              <th scope="row">1</th>
              <td>{{$user->name}}</td>
              <td>{{$active_clients}}</td>
              <td>{{ $posted_tables }}</td>
              <td>{{ $posted_workouts }}</td>
              <td>{{ $renewal_table }}</td>
              <td>{{ $renewal_workout }}</td>
              <td scope="row"><a href="{{ route('teams.edit',$user->id )}}" class="ms-btn-icon btn-square btn-info"><i class="flaticon-information" style="margin-right: 0px;"></i></a></td>

            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  @endif
  @if($role_name == 'Admin')
  <div class="ms-panel">
    <div class="ms-panel-header">
      <h6>All Admins</h6>
    </div>
    <div class="ms-panel-body">
      <p class="ms-directions"></p>
      <div class="table-responsive">
        <table class="table table-hover thead-primary">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Admin</th>
              <th scope="col">Active Clients</th>
              <th scope="col">Tables</th>
              <th scope="col">Workouts</th>
              <th scope="col">Renewals</th>
              <th scope="col">Renewal Tables</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            @php
            $active_clients = DB::table('nutritionist_clients')->where('nutritionist_id',$user->id)->count();
            $posted_tables = DB::table('nutritionist_clients')->where('nutritionist_id',$user->id)->where('table_status','due')->count();
            $posted_workouts = DB::table('nutritionist_clients')->where('nutritionist_id',$user->id)->where('workout_status','due')->count();
            $renewal_table = DB::table('nutritionist_clients')->where('nutritionist_id',$user->id)->where('table_status','posted')->count();
            $renewal_workout = DB::table('nutritionist_clients')->where('nutritionist_id',$user->id)->where('workout_status','posted')->count();
            @endphp
            <tr>
              <th scope="row">1</th>
              <td>{{$user->name}}</td>
              <td>{{$active_clients}}</td>
              <td>{{ $posted_tables }}</td>
              <td>{{ $posted_workouts }}</td>
              <td>{{ $renewal_table }}</td>
              <td>{{ $renewal_workout }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  @endif
  @if($role_name == 'Customer Service')
  <div class="ms-panel">
    <div class="ms-panel-header">
      <h6>No User assigned to this team</h6>
    </div>
  </div>
  @endif
  @if($role_name == 'Subscription Coordinators')
  <div class="ms-panel">
    <div class="ms-panel-header">
      <h6>No User assigned to this team</h6>
    </div>
  </div>
  @endif
  @if($role_name == 'Supervisors')
  <div class="ms-panel">
    <div class="ms-panel-header">
      <h6>No User assigned to this team</h6>
    </div>
  </div>
  @endif
</div>
@endsection