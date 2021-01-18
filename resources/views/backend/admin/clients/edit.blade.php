@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-12">
		<nav aria-label="breadcrumb " class="ms-panel-custom">
			<ol class="breadcrumb pl-0">
				<li class="breadcrumb-item"><a href="/"><i class="material-icons">home</i> Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('clients.index')}}">Client List</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Client</li>
			</ol>
			<a href="{{ URL::previous() }}" class="ms-btn-icon btn-square btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i></a>	
		</nav>
	</div>
	<div class="col-xl-8 col-md-12">
		<div class="ms-panel ms-panel-fh">
			<div class="ms-panel-header">
				<h6>Edit Client - {{$client->firstname}} {{$client->lastname}}</h6>
			</div>
			<div class="ms-panel-body">
				<form class="needs-validation clearfix" method="POST" action="{{route('clients.update',$client->id)}}" novalidate>
					@csrf
					{{ method_field('PUT') }}
					<div class="form-row">
						<div class="col-xl-6 col-md-12 mb-3">
							<label for="firstname">First Name</label>
							<div class="input-group">
								<input type="text" id="firstname" name="firstname" class="form-control" placeholder="First Name" value="{{$client->firstname}}" required>
								<div class="invalid-feedback">
									Please Enter a First Name.
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-12 mb-3">
							<label for="lastname">Last Name</label>
							<div class="input-group">
								<input type="text" id="lastname" name="lastname" class="form-control" placeholder="Last Name" value="{{$client->lastname}}" required>
								<div class="invalid-feedback">
									Please Enter a Last Name.
								</div>
							</div>
						</div>
						<div class="col-xl-12 col-md-12 mb-3">
							<label for="gender">Gender</label>
							<div class="input-group">
								<select id="gender" name="gender" class="form-control" placeholder="Password" required>
									<option value="" selected>Choose Gender</option>
									<option value="male" @if($client->gender == 'male') selected @endif>Male</option>
									<option value="female" @if($client->gender == 'female') selected @endif>Female</option>
								</select>
								<div class="invalid-feedback">
									Please Select Gender.
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-12 mb-3">
							<label for="phone">Phone</label>
							<div class="input-group">
								<input type="text" id="phone" name="phone" class="form-control" placeholder="Phone" value="{{ $client->phone }}" required>
								<div class="invalid-feedback">
									Please Enter Phone Number.
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-12 mb-3">
							<label for="email">Email</label>
							<div class="input-group">
								<input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{$client->email}}" required>
								<div class="invalid-feedback">
									Please Enter Email.
								</div>
							</div>
						</div>
						<div class="col-md-12 pt-4">
							<label class="ms-switch">
								<input type="checkbox" @if($client->status == "on") checked="" @endif name="status">
								<span class="ms-switch-slider ms-switch-primary square"></span>
							</label>
							<span> Enable </span>
						</div>					
					</div>
					<button class="btn btn-primary float-right" type="submit">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection