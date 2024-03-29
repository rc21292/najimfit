@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-12">
		<nav aria-label="breadcrumb " class="ms-panel-custom">
			<ol class="breadcrumb pl-0">
				<li class="breadcrumb-item"><a href="/"><i class="material-icons">home</i> Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('clients.index')}}">Clients List</a></li>
				<li class="breadcrumb-item active" aria-current="page">Add Client</li>
			</ol>
		</nav>
	</div>
	<div class="col-xl-8 col-md-12">
		@if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		<div class="ms-panel ms-panel-fh">
			<div class="ms-panel-header">
				<h6>Client Form</h6>
			</div>
			<div class="ms-panel-body">
				<form class="needs-validation clearfix" method="POST" action="{{route('clients.store')}}" novalidate>
					@csrf
					<div class="form-row">
						<div class="col-xl-6 col-md-12 mb-3">
							<label for="firstname">First Name</label>
							<div class="input-group">
								<input type="text" id="firstname" name="firstname" class="form-control" placeholder="First Name" required>
								<div class="invalid-feedback">
									Please Enter a First Name.
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-12 mb-3">
							<label for="lastname">Last Name</label>
							<div class="input-group">
								<input type="text" id="lastname" name="lastname" class="form-control" placeholder="Last Name" required>
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
									<option value="male">Male</option>
									<option value="female">Female</option>
								</select>
								<div class="invalid-feedback">
									Please Select Gender.
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-12 mb-3">
							<label for="phone">Phone</label>
							<div class="input-group">
								<input type="number" id="phone" name="phone" class="form-control" placeholder="Phone" required>
								<div class="invalid-feedback">
									Please Enter Phone Number.
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-12 mb-3">
							<label for="email">Email</label>
							<div class="input-group">
								<input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
								<div class="invalid-feedback">
									Please Enter Email.
								</div>
							</div>
						</div>
						<div class="col-xl-12 col-md-12 mb-3">
							<label for="password">Password</label>
							<div class="input-group">
								<input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
								<div class="invalid-feedback">
									Please Enter Password.
								</div>
							</div>
						</div>
						<div class="col-xl-12 col-md-12 mb-3">
							<label for="package">Package</label>
							<div class="input-group">
								<select id="package" name="package" class="form-control" required>
									@foreach($packages as $package)
									<option value="{{$package->id}}">{{$package->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-12 pt-4">
							<label class="ms-switch">
								<input type="checkbox" checked="" name="status">
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