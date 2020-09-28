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
		<a href="{{ route('allclients') }}">
			<div class="ms-panel ms-widget ms-panel-hoverable has-border ms-has-new-msg ms-notification-widget">
				<span class="msg-count">{{ $total_clients }}</span>
				<div class="ms-panel-body media">
					<i class="material-icons">person</i>
					<div class="media-body">
						<h6>All</h6>
						<span></span>
					</div>
				</div>
			</div>
		</a>
	</div>
	@foreach($users as $user)
	<div class="col-xl-3 col-md-6">
		<a href="{{route('assign-table.show',$user->id)}}">
			<div class="ms-panel ms-widget ms-panel-hoverable has-border ms-has-new-msg ms-notification-widget">
				<span class="msg-count">{{ $user->clients_count }}</span>
				<div class="ms-panel-body media">
					<i class="material-icons">person</i>
					<div class="media-body">
						<h6>{{ $user->name }}</h6>
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