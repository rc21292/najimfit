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
				<li class="breadcrumb-item"><a href="{{ route('privacy-policy.index')}}">Privacy Policy</a></li>
				<li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
			</ol>
		</nav>
	</div>
	<div class="col-xl-12 col-md-12">
		<div class="ms-panel ms-panel-fh">
			<div class="ms-panel-header">
				<h6>Privacy Policy Form</h6>
			</div>
			<div class="ms-panel-body">
				<form class="needs-validation clearfix" method="POST" action="{{route('privacy-policy.update',$privacy_policy->id)}}" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="col-md-12">
						<label for="privacy_policy">Privacy Policy</label>
						<div class="input-group">
							<textarea rows="12" name="privacy_policy" class="form-control" placeholder="" required>{{$privacy_policy->content}}</textarea>
							<div class="invalid-feedback">
								Mention Privacy Policy
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<label for="privacy_policy">Privacy Policy(in Arabic)</label>
						<div class="input-group">
							<textarea rows="12" name="content_arabic" class="form-control" placeholder="" required>{{$privacy_policy->content_arabic}}</textarea>
							<div class="invalid-feedback">
								Mention Privacy Policy
							</div>
						</div>
					</div>					<input type="submit" name="Update" value="Update" class="btn btn-primary">	
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
{{-- <script>
	CKEDITOR.replace( 'privacy_policy' );
</script> --}}
@endpush