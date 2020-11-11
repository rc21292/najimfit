@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-12">
		<nav aria-label="breadcrumb " class="ms-panel-custom">
			<ol class="breadcrumb pl-0">
				<li class="breadcrumb-item"><a href="/"><i class="material-icons">home</i> Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('faqs.index')}}">Faqs List</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Faq</li>
			</ol>
		</nav>
	</div>
	<div class="col-xl-8 col-md-12">
		<div class="ms-panel ms-panel-fh">
			<div class="ms-panel-header">
				<h6>Edit FAQs</h6>
			</div>
			<div class="ms-panel-body">
				<form class="needs-validation clearfix" method="POST" action="{{route('faqs.update',$faqs->id)}}" novalidate>
					@csrf
					{{ method_field('PUT') }}
					<div class="form-row">
						<div class="col-xl-12 col-md-12 mb-3">
							<label for="question">Question</label>
							<div class="input-group">
								<input type="text" id="question" name="question" class="form-control" placeholder="Question" value="{{$faqs->question}}" required>
								<div class="invalid-feedback">
									Please Enter a Question.
								</div>
							</div>
						</div>
						<div class="col-xl-12 col-md-12 mb-3">
							<label for="answer">Answer</label>
							<div class="input-group">
								<textarea rows="5" id="answer" name="answer" class="form-control" placeholder="Answer" required>{{$faqs->answer}}</textarea>
								<div class="invalid-feedback">
									Please Enter a Answer.
								</div>
							</div>
						</div>
						<div class="col-md-12 pt-4">
							<label class="ms-switch">
								<input type="checkbox" @if($faqs->status == "1") checked="" @endif name="status">
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