@extends('layouts.app')
@section('head')
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<nav aria-label="breadcrumb " class="ms-panel-custom">
			<ol class="breadcrumb pl-0">
				<li class="breadcrumb-item"><a href="/"><i class="material-icons">home</i> Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('about.index')}}">About</a></li>
				<li class="breadcrumb-item active" aria-current="page">About</li>
			</ol>
		</nav>
	</div>
	<div class="col-xl-12 col-md-12">
		<div class="ms-panel ms-panel-fh">
			<div class="ms-panel-header">
				<h6>About Form</h6>
			</div>
			<div class="ms-panel-body">
				<form class="needs-validation clearfix" method="POST" action="{{route('aboutus.update',$about->id)}}" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="col-md-12">
						<label for="term">About</label>
						<div class="input-group">

							<div class="input-group">
								<textarea rows="12" name="about" id="editor" class="form-control" placeholder="" required>{{$about->content}}</textarea>
								<div class="invalid-feedback">
									Mention About Us
								</div>
							</div>

							<div class="invalid-feedback">
								Mention About Us
							</div>
						</div>
					</div>			
					<input type="submit" name="Update" value="Update" class="btn btn-primary">	
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script type="text/javascript">
	CKEDITOR.replace('editor');
</script>
@endpush