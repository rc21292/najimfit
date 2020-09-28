@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-12">
		<nav aria-label="breadcrumb " class="ms-panel-custom">
			<ol class="breadcrumb pl-0">
				<li class="breadcrumb-item"><a href="/"><i class="material-icons">home</i> Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('coupons.index')}}">Coupons List</a></li>
				<li class="breadcrumb-item active" aria-current="page">Add Coupon</li>
			</ol>
		</nav>
	</div>
	<div class="col-xl-8 col-md-12">
		<div class="ms-panel ms-panel-fh">
			<div class="ms-panel-header">
				<h6>Coupon Form</h6>
			</div>
			<div class="ms-panel-body">
				<form class="needs-validation clearfix" method="POST" action="{{route('coupons.store')}}" novalidate>
					@csrf
					<div class="form-row">
						<div class="col-xl-6 col-md-12 mb-3">
							<label for="name">Coupon Name</label>
							<div class="input-group">
								<input type="text" id="name" name="name" class="form-control" placeholder="Coupon Name" value="{{old('name')}}" required>
								<div class="invalid-feedback">
									Please Enter a Coupon Name.
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-12 mb-3">
							<label for="code">Code</label>
							<div class="input-group">
								<input type="text" id="code" name="code" class="form-control" placeholder="Coupon Code" required>
								<div class="invalid-feedback">
									Please Enter a Coupon Code.
								</div>
							</div>
						</div>
						<div class="col-xl-12 col-md-12 mb-3">
							<label for="package">Packages</label>
							<div class="input-group">
								<select id="package" name="package" class="form-control" placeholder="Package" required>
									<option value="" selected>Choose Package</option>
									@foreach($packages as $package)
									<option value="{{$package->id}}">{{$package->name}}</option>
									@endforeach
								</select>
								<div class="invalid-feedback">
									Please Select Package.
								</div>
							</div>
						</div>
						<div class="col-xl-12 col-md-12 mb-3">
							<label for="type">Discount Type</label>
							<div class="input-group">
								<select id="type" name="type" class="form-control" placeholder="Type" required>
									<option value="" selected>Choose Type</option>
									<option value="P">Percentage</option>
									<option value="F">Fixed Amount</option>
								</select>
								<div class="invalid-feedback">
									Please Select Discount Type.
								</div>
							</div>
						</div>
						<div class="col-xl-12 col-md-12 mb-3">
							<label for="discount">Discount</label>
							<div class="input-group">
								<input type="number" id="discount" name="discount" class="form-control" placeholder="Discount(Percentage or Fixed)" required>
								<div class="invalid-feedback">
									Please Enter Discount.
								</div>
							</div>
						</div>
						<div class="col-xl-06 col-md-12 mb-3">
							<label for="start">Start Date</label>
							<div class="input-group">
								<input type="date" class="form-control" name="start" id="start" placeholder="Start Date" value="{{old('start')}}" required>
								<div class="invalid-feedback">
									Please Enter Start Date.
								</div>
							</div>
						</div>
						<div class="col-xl-06 col-md-12 mb-3">
							<label for="end">End Date</label>
							<div class="input-group">
								<input type="date" class="form-control" name="end" id="end" placeholder="End Date" value="{{old('end')}}" required>
								<div class="invalid-feedback">
									Please Enter End Date.
								</div>
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