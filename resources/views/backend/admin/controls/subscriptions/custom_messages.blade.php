@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-12">
		<nav aria-label="breadcrumb " class="ms-panel-custom">
			<ol class="breadcrumb pl-0">
				<li class="breadcrumb-item"><a href="/"><i class="material-icons">home</i> Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('controls.index')}}">Controls</a></li>
				<li class="breadcrumb-item active" aria-current="page">Subscripotion Custom Messages</li>
			</ol>
			<a href="{{ route('subscriptions.index')}}" class="ms-btn-icon btn-square btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i></a>	
		</nav>
		@include('backend.admin.includes.flashmessage')
	</div>
	<div class="col-xl-8 col-md-12">
		<div class="ms-panel ms-panel-fh">
			<div class="ms-panel-header">
				<h6>Edit Subscripotion Custom Messages</h6>
			</div>
			<div class="ms-panel-body">
				<form class="needs-validation clearfix" method="POST" action="{{route('update-custom-messages')}}" novalidate>
					@csrf
					{{ method_field('POST') }}
					<div class="form-row">
						<div class="col-xl-12 col-md-12 mb-3">
							<label for="firstname">Messages to blocked user for accepting Subscriptions:</label>
							<div class="input-group">
								<textarea id="accept_subscription_message" rows="6" name="accept_subscription_message" class="form-control" placeholder="Message">{{$subscription_settings->accept_subscription_message}}</textarea>
								<div class="invalid-feedback">
									Please Enter Message.
								</div>
							</div>
						</div>
						<div class="col-xl-12 col-md-12 mb-3">
							<label for="firstname">Messages to blocked user for accepting Subscriptions(Arabic):</label>
							<div class="input-group">
								<textarea id="accept_subscription_message_arabic" rows="6" name="accept_subscription_message_arabic" class="form-control" placeholder="Message">{{$subscription_settings->accept_subscription_message_arabic}}</textarea>
								<div class="invalid-feedback">
									Please Enter Message.
								</div>
							</div>
						</div>
						<div class="col-xl-12 col-md-12 mb-3">
							<label for="lastname">Message to Waitinglist Users:</label>
							<div class="input-group">
								<textarea id="waitinglist_subscription_message" rows="6" name="waitinglist_subscription_message" class="form-control" placeholder="Message">{{$subscription_settings->waitinglist_subscription_message}}</textarea>
								<div class="invalid-feedback">
									Please Enter Message.
								</div>
							</div>
						</div>
						<div class="col-xl-12 col-md-12 mb-3">
							<label for="lastname">Message to Waitinglist Users(Arabic):</label>
							<div class="input-group">
								<textarea id="waitinglist_subscription_message_arabic" rows="6" name="waitinglist_subscription_message_arabic" class="form-control" placeholder="Message">{{$subscription_settings->waitinglist_subscription_message_arabic}}</textarea>
								<div class="invalid-feedback">
									Please Enter Message.
								</div>
							</div>
						</div>						
					</div>
					<button class="btn btn-primary float-right" type="submit">Update</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection