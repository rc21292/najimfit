@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-12">
		<nav aria-label="breadcrumb " class="ms-panel-custom">
			<ol class="breadcrumb pl-0">
				<li class="breadcrumb-item"><a href="/"><i class="material-icons">home</i> Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('faqs.index')}}">FAQs List</a></li>
				<li class="breadcrumb-item active" aria-current="page">Add Faqs</li>
			</ol>
			<a href="{{ URL::previous() }}" class="ms-btn-icon btn-square btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i></a>
		</nav>
	</div>
	<div class="col-xl-8 col-md-12">
		<div class="ms-panel ms-panel-fh">
			<div class="ms-panel-header">
				<h6>Faq Form</h6>
			</div>
			<div class="ms-panel-body">
				<form class="needs-validation clearfix" method="POST" action="{{route('faqs.store')}}" novalidate>
					@csrf
					<div class="form-row">
						<div class="col-xl-12 col-md-12 mb-3">
							<label for="question">Question</label>
							<div class="input-group">
								<input type="text" id="question" name="question" class="form-control" placeholder="Question"  required>
								<div class="invalid-feedback">
									Please Enter a Question.
								</div>
							</div>
						</div>
						<div class="col-xl-12 col-md-12 mb-3">
							<label for="question_arabic">Question(in Arabic)</label>
							<div class="input-group">
								<input type="text" id="question_arabic" name="question_arabic" class="form-control" placeholder="Question(in Arabic)" >
								<div class="invalid-feedback">
									Please Enter a Question(in Arabic).
								</div>
							</div>
						</div>
						<div class="col-xl-12 col-md-12 mb-3">
							<label for="answer">Answer</label>
							<div class="input-group">
								<textarea rows="5" id="answer" name="answer" class="form-control" placeholder="Answer" required></textarea>
								<div class="invalid-feedback">
									Please Enter a Answer.
								</div>
							</div>
						</div>
						<div class="col-xl-12 col-md-12 mb-3">
							<label for="answer_arabic">Answer(in Arabic)</label>
							<div class="input-group">
								<textarea rows="5" id="answer_arabic" name="answer_arabic" class="form-control" placeholder="Answer(in Arabic)"></textarea>
								<div class="invalid-feedback">
									Please Enter a Answer(in Arabic).
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