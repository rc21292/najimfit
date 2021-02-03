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
		<a href="{{ route('performance.index') }}" class="active">
			<div class="ms-panel ms-widget ms-panel-hoverable has-border ms-has-new-msg ms-notification-widget">
				<div class="ms-panel-body media">
					<i class="flaticon-chat"></i>
					<div class="media-body">
						<h6>Chats/day</h6>
						<span></span>
					</div>
				</div>
			</div>
		</a>
	</div>
	<div class="col-xl-3 col-md-6">
		<a href="{{ route('performance-tables') }}">
			<div style="background: ghostwhite;" class="ms-panel ms-widget ms-panel-hoverable has-border ms-has-new-msg ms-notification-widget">
				<div class="ms-panel-body media">
					<i class="fas fa-table"></i>
					<div class="media-body">
						<h6>Tables/day</h6>
						<span></span>
					</div>
				</div>
			</div>
		</a>
	</div>

	<div class="col-xl-3 col-md-6">
		<a href="{{ route('performance-complaints') }}">
			<div class="ms-panel ms-widget ms-panel-hoverable has-border ms-has-new-msg ms-notification-widget">
				<div class="ms-panel-body media">
					<i class="material-icons">person</i>
					<div class="media-body">
						<h6>Complaints/day</h6>
						<span></span>
					</div>
				</div>
			</div>
		</a>
	</div>

	<div class="col-md-12">
		<div class="ms-panel">
			<hr>
			<div class="ms-panel-header">
				<h6>Tables/day:</h6>
			</div>
			<div class="ms-panel-body">
				<div class="row">
					<div class="col-sm-6 col-xs-12">
						<div class="ms-panel ms-panel-fh">
							<div class="ms-panel-body clearfix">
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane fade active show" id="tab13">
										<div class="ms-panel-body">
											<canvas id="tables-bar-chart"></canvas>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
@endsection
@push('scripts')
<script src="{{asset('backend/assets/js/index-tables-chart.js')}}"> </script>
@endpush