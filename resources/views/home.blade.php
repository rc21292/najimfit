@extends('layouts.app')
@section('head')
<title>Admin |Dashboard</title>
@endsection
@role('Admin')
@section('content')
<h2>Dashboard</h2>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('client-chats.index')}}">
            <div class="ms-card card-gradient-success ms-widget ms-infographics-widget">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>Chats</h6>
                        <p class="ms-card-change"> {{ $total_client_chat }}</p>
                    </div>
                </div>
                <i class="fab fa-stack-exchange"></i>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6">
        <a href="{{route('assign-table.index')}}">
            <div class="ms-card card-gradient-secondary ms-widget ms-infographics-widget">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>Due tables</h6>
                        <p class="ms-card-change"> {{ $table_due }}</p>
                    </div>
                </div>
                <i class="fa fa-table"></i>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6">
        <a href="{{route('renew-table.index')}}">
            <div class="ms-card card-gradient-warning ms-widget ms-infographics-widget">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>Renewals tables</h6>
                        <p class="ms-card-change">{{ $table_renewals }}</p>
                    </div>
                </div>
                <i class="fa fa-redo"></i>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6">
        <a href="{{ route('clients.index')}}">
            <div class="ms-card card-gradient-info ms-widget ms-infographics-widget">
                <div class="ms-card-body pos media">
                    <div class="media-body">
                        <h6>Clients</h6>
                        <p class="ms-card-change"> {{ $total_clients }}</p>
                    </div>
                </div>
                <i class="far fa-user-circle"></i>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6">
        <a href="{{ url('dashboard/staff-chats')}}">
            <div class="ms-card card-gradient-secondary ms-widget ms-infographics-widget">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>Staff Chats</h6>
                        <p class="ms-card-change"> {{ $total_staff_chat }}</p>
                    </div>
                </div>
                <i class="fab fa-teamspeak"></i>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6">
        <a href="{{route('assign-workout.index')}}">
            <div class="ms-card card-gradient-success ms-widget ms-infographics-widget">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>Due Workouts</h6>
                        <p class="ms-card-change"> {{ $workout_due }}</p>
                    </div>
                </div>
                <i class="fa fa-burn"></i>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6">
        <a href="{{route('renew-workout.index')}}">
            <div class="ms-card card-gradient-secondary ms-widget ms-infographics-widget">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>Renewed Workouts</h6>
                        <p class="ms-card-change"> {{ $workout_renewals }}</p>
                    </div>
                </div>
                <i class="fa fa-sync"></i>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6">
        <a href="{{ route('requests.index')}}">
            <div class="ms-card card-gradient-warning ms-widget ms-infographics-widget">
                <div class="ms-card-body pos media">
                    <div class="media-body">
                        <h6>Requests</h6>
                        <p class="ms-card-change"> {{ $total_requests }}</p>
                    </div>
                </div>
                <i class="fa fa-anchor"></i>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('complaints.index')}}">
            <div class="ms-card card-gradient-success ms-widget ms-infographics-widget">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>Complaints</h6>
                        <p class="ms-card-change"> {{ $total_complaints }}</p>
                    </div>
                </div>
                <i class="fas fa-exclamation-triangle"></i>
            </div>
        </a>
    </div>



    <div class="col-xl-3 col-md-6">
        <a href="{{ route('teams.index')}}">
            <div class="ms-card card-gradient-info ms-widget ms-infographics-widget">
                <div class="ms-card-body pos media">
                    <div class="media-body">
                        <h6>Teams</h6>
                        <p class="ms-card-change"> {{$total_users}}</p>
                    </div>
                </div>
                <i class="fas fa-users"></i>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6">
        <a href="{{ route('meeting.index')}}">
            <div class="ms-card card-gradient-secondary ms-widget ms-infographics-widget">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>Share & Meetings</h6>
                        <p class="ms-card-change"> {{ $total_meetings }}</p>
                    </div>
                </div>
                <i class="fa fa-handshake"></i>
            </div>
        </a>
    </div>



    <div class="col-xl-3 col-md-6">
        <a href="{{ route('notes.index')}}">
            <div class="ms-card card-gradient-secondary ms-widget ms-infographics-widget">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>Notes</h6>
                        <p class="ms-card-change"> {{ $total_notes }}</p>
                    </div>
                </div>
                <i class="far fa-clipboard"></i>
            </div>
        </a>
    </div>


</div>
<h2>Quick Links</h2>
<div class="row">    
    <br>
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('controls.index')}}">
            <div class="ms-card card-gradient-secondary ms-widget ms-infographics-widget">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>Controls</h6>
                        <p class="ms-card-change"> <br></p>
                    </div>
                </div>
                <i class="fa fa-cogs"></i>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6">
        <a href="{{ route('datas.index')}}">
            <div class="ms-card card-gradient-warning ms-widget ms-infographics-widget">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>Data </h6>
                        <p class="ms-card-change"> <br> </p>
                    </div>
                </div>
                <i class="fa fa-database"></i>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6">
        <a href="{{ route('fullcalendar-index')}}">
            <div class="ms-card card-gradient-success ms-widget ms-infographics-widget">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>Calender</h6>
                        <p class="ms-card-change"> <br></p>
                    </div>
                </div>
                <i class="fa fa-calendar"></i>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('my-account.index')}}">
            <div class="ms-card card-gradient-warning ms-widget ms-infographics-widget">
                <div class="ms-card-body pos media">
                    <div class="media-body">
                        <h6>My Profile</h6>
                        <p class="ms-card-change"> <br> </p>
                    </div>
                </div>
                <i class="fas fa-id-card"></i>
            </div>
        </a>
    </div>  
</div>
@endsection
@endrole
@role('Nutritionist')
@section('content')
<h2>Dashboard</h2>
<div class="row">

    <div class="col-xl-3 col-md-6">
        <a href="{{route('chat.index')}}">
            <div class="ms-card card-gradient-success ms-widget ms-infographics-widget">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>Chats</h6>
                        <p class="ms-card-change"> {{ $total_client_chat }}</p>
                    </div>
                </div>
                <i class="fab fa-stack-exchange"></i>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6">
        <a href="{{route('assign-table.index')}}">
            <div class="ms-card card-gradient-secondary ms-widget ms-infographics-widget">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>New tables</h6>
                        <p class="ms-card-change"> {{ $table_due }}</p>
                    </div>
                </div>
                <i class="fa fa-table"></i>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6">
        <a href="{{route('renew-table.index')}}">
            <div class="ms-card card-gradient-warning ms-widget ms-infographics-widget">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>Renewed tables</h6>
                        <p class="ms-card-change">{{ $table_renewals }}</p>
                    </div>
                </div>
                <i class="fa fa-redo"></i>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6">
        <a href="{{ route('clients.index')}}">
            <div class="ms-card card-gradient-info ms-widget ms-infographics-widget">
                <div class="ms-card-body pos media">
                    <div class="media-body">
                        <h6>Active Clients</h6>
                        <p class="ms-card-change"> {{ $total_clients }}</p>
                    </div>
                </div>
                <i class="far fa-user-circle"></i>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('notes.index')}}">
            <div class="ms-card card-gradient-secondary ms-widget ms-infographics-widget">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>Notes</h6>
                        <p class="ms-card-change"> {{ $total_notes }}</p>
                    </div>
                </div>
                <i class="far fa-clipboard"></i>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6">
        <a href="{{route('assign-workout.index')}}">
            <div class="ms-card card-gradient-success ms-widget ms-infographics-widget">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>New Workouts</h6>
                        <p class="ms-card-change"> {{ $workout_due }}</p>
                    </div>
                </div>
                <i class="fa fa-burn"></i>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6">
        <a href="{{route('renew-workout.index')}}">
            <div class="ms-card card-gradient-secondary ms-widget ms-infographics-widget">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>Renewed Workouts</h6>
                        <p class="ms-card-change"> {{ $workout_renewals }}</p>
                    </div>
                </div>
                <i class="fa fa-sync"></i>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6">
        <a href="{{ url('dashboard/staff-chats')}}">
            <div class="ms-card card-gradient-secondary ms-widget ms-infographics-widget">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>Staff Chats</h6>
                        <p class="ms-card-change"> {{ $total_staff_chat }}</p>
                    </div>
                </div>
                <i class="fab fa-teamspeak"></i>
            </div>
        </a>
    </div>

    {{-- <div class="col-xl-3 col-md-6">
        <div class="ms-card card-gradient-secondary ms-widget ms-infographics-widget">
            <div class="ms-card-body media">
                <div class="media-body">
                    <h6>Performance</h6>
                    <p class="ms-card-change"> 4567</p
                </div>
            </div>
            <i class="fa fa-bolt"></i>
        </div>
    </div> --}}

    
</div>
<h2>Quick Links</h2>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('fullcalendar-index')}}">
            <div class="ms-card card-gradient-success ms-widget ms-infographics-widget">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>Calender</h6>
                        <p class="ms-card-change"> <br></p>
                    </div>
                </div>
                <i class="fa fa-calendar"></i>
            </div>
        </a>
    </div>
</div>
@endsection
@endrole
@push('scripts')

@endpush