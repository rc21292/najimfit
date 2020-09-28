@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-12">
		<nav aria-label="breadcrumb " class="ms-panel-custom">
			<ol class="breadcrumb pl-0">
				<li class="breadcrumb-item"><a href="/"><i class="material-icons">home</i> Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('question.index')}}">Question List</a></li>
				<li class="breadcrumb-item active" aria-current="page">Add Question</li>
			</ol>
		</nav>
	</div>
	<div class="col-xl-8 col-md-12">
		<div class="ms-panel ms-panel-fh">
			<div class="ms-panel-header">
				<h6>Question Form</h6>
			</div>
			<div class="ms-panel-body">
				<form class="needs-validation clearfix" method="POST" action="{{route('question.store')}}" novalidate>
					@csrf
					<div class="form-row">
						<div class="col-xl-6 col-md-12 mb-3">
							<label for="gender">Select Gender</label>
							<div class="input-group">
								<select class="form-control" name="gender" id="gender" required>
									<option value="both">Both</option>
									<option value="male">Male</option>
									<option value="female">Female</option>
								</select>
								<div class="invalid-feedback">
									Please select a Gender.
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-12">
							<label for="sort">Sort Order</label>
							<div class="input-group">
								<input type="number" class="form-control" name="sort" id="sort" placeholder="Sort Order" required value="{{$sort}}">
								<div class="invalid-feedback">
									Please provide a Sort Number.
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<label for="question">Question</label>
							<div class="input-group">
								<textarea rows="5" id="question" name="question" class="form-control" placeholder="Question" required></textarea>
								<div class="invalid-feedback">
									Please Enter a Question.
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