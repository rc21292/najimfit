@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-12">
		<nav aria-label="breadcrumb " class="ms-panel-custom">
			<ol class="breadcrumb pl-0">
				<li class="breadcrumb-item"><a href="/"><i class="material-icons">home</i> Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('complaints.index')}}">Complaints List</a></li>
				<li class="breadcrumb-item active" aria-current="page">Add Complaint</li>
			</ol>
		</nav>
	</div>
	<div class="col-xl-8 col-md-12">
		<div class="ms-panel ms-panel-fh">
			<div class="ms-panel-header">
				<h6>Complaint Form</h6>
				<a style="float: right;margin-top: -27px;" href="{{ url(Session::get('back_request_url')) }}" class="ms-btn-icon btn-square btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i></a>	
			</div>
			<div class="ms-panel-body">
				<form class="needs-validation clearfix" method="POST" action="{{route('complaints.store')}}" novalidate>
					@csrf
					<div class="form-row">
						<div class="col-xl-12 col-md-12 mb-3">
							<label>Report about the Client</label>
							<div class="input-group">
								<input type="hidden" name="client_id" value="{{ $id }}">
								<textarea rows="6" placeholder="Enter Report" class="form-control" name="reason" value="" required></textarea>
								<div class="invalid-feedback">
									Please Enter Report about the Client.
								</div>
							</div>
						</div>					
					</div>
					<button class="btn btn-primary float-right" type="submit">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection