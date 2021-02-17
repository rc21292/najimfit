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
				<li class="breadcrumb-item active" aria-current="page">Settings</li>
			</ol>
		</nav>
		@include('backend.admin.includes.flashmessage')
	</div>
	<div class="col-xl-6 col-md-6">
		<div class="ms-panel ms-panel-fh">
			<div class="ms-panel-header">
				<h6>Update Settings</h6>
			</div>
			<div class="ms-panel-body">
				<form class="needs-validation clearfix" method="POST" action="{{route('settings.store')}}" enctype="multipart/form-data">
					@csrf
					@foreach($settings as $key => $setting)
					@if($setting->name == 'in_app_purchase')

					<div class="col-md-12">
						<label for="term">{{ ucwords(str_replace('_', ' ', $setting->name)) }}</label>
						<div class="input-group">
							<select name="{{ $setting->name }}" class="form-control" required>
								<option value="1" @if ($setting->value == 1) selected @endif>Yes</option>
								<option value="0" @if ($setting->value == 0) selected @endif>No</option>
							</select>
							<div class="invalid-feedback">
								Mention {{ $key }}
							</div>
						</div>
					</div>
					@else
					<div class="col-md-12">
						<label for="term">{{ ucwords(str_replace('_', ' ', $setting->name)) }}</label>
						<div class="input-group">
							<input type="text" name="{{ $setting->name }}" class="form-control" placeholder="" value="{{ $setting->value }}" required>
							<div class="invalid-feedback">
								Mention {{ $key }}
							</div>
						</div>
					</div>
					@endif
					@endforeach

					<input type="submit" name="Update" value="Update" class="btn btn-primary">	
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
{{-- <script>
	CKEDITOR.replace( 'about' );
</script> --}}
@endpush