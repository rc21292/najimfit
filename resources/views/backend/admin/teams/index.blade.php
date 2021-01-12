@extends('layouts.app')
@section('head')
<link href="{{asset('backend/assets/css/datatables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		@include('backend.admin.includes.flashmessage')
	</div>
	@foreach($roles as $role)
	<div class="col-xl-3 col-md-6">
		<a href="{{route('teams.show',$role->name)}}">
			<div class="ms-panel ms-widget ms-panel-hoverable has-border ms-has-new-msg ms-notification-widget">
				<span class="msg-count">{{$role->users_count}}</span>
				<div class="ms-panel-body media">
					<i class="material-icons">person</i>
					<div class="media-body">
						<h6>{{ $role->name }}</h6>
						<span></span>
					</div>
				</div>
			</div>
		</a>
	</div>
	@endforeach
</div>
@endsection
@push('scripts')
@endpush