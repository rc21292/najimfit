@extends('layouts.app')	
@section('content')
<div class="row">
	<div class="col-md-12">
		<nav aria-label="breadcrumb " class="ms-panel-custom">
			<ol class="breadcrumb pl-0">
				<li class="breadcrumb-item"><a href="/"><i class="material-icons">home</i> Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('diet-informations.index')}}">Diet Information List</a></li>
				<li class="breadcrumb-item active" aria-current="page">Add Diet Information</li>
			</ol>
		</nav>
	</div>
	<div class="col-xl-8 col-md-12">
		<div class="ms-panel ms-panel-fh">
			<div class="ms-panel-header">
				<h6>Edit Diet Information</h6>
			</div>
			<div class="ms-panel-body">
				<form class="needs-validation clearfix" method="POST" action="{{route('diet-informations.update',$diet_informations->id)}}" novalidate>
					@csrf
					{{ method_field('PUT') }}
					<div class="form-row">
					<div class="col-xl-12 col-md-12 mb-3">
						<label>Information Name</label>
						<div class="input-group">
							<input type="text" placeholder="Information Name" class="form-control" name="name" value="{{$diet_informations->name}}" required>
							<div class="invalid-feedback">
									Please Enter Information Name.
								</div>
								</div>
					</div>
					<div class="col-xl-12 col-md-12 mb-3">
						<label>Information Name(in Arabic)</label>
						<div class="input-group">
							<input type="text" placeholder="اسم المعلومات" class="form-control" name="name_arabic" value="{{$diet_informations->name_arabic}}" dir="rtl">
					</div>
					</div>
					<div class="col-xl-12 col-md-12 mb-3">
						<label>Information Description</label>
						<div class="input-group">
							<textarea rows="6" placeholder="Write Information" class="form-control" name="description" required>{{$diet_informations->information}}</textarea>
						<div class="invalid-feedback">
									Please Enter Information Description.
								</div>
								</div>

					</div>
					<div class="col-xl-12 col-md-12 mb-3">
						<label>Information Description(in Arabic)</label>
						<div class="input-group">
							<textarea rows="6" placeholder="وصف المعلومات" class="form-control" name="description_arabic" dir="rtl">{{$diet_informations->information_arabic}}</textarea>

					</div>
					</div>
					<button type="submit" class="btn btn-primary">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection