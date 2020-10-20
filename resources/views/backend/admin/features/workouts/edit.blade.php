@extends('layouts.app')
@section('head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<style>
	input {
		text-align: center;
	}
	.kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
		margin: 0;
		padding: 0;
		border: none;
		box-shadow: none;
		text-align: center;
	}
	.kv-avatar {
		display: inline-block;
	}
	.kv-avatar .file-input {
		display: table-cell;
		width: 237px;
	}
	.kv-reqd {
		color: red;
		font-family: monospace;
		font-weight: normal;
	}
	.input-group.avat {
		display: block;
	}

</style>
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<nav aria-label="breadcrumb " class="ms-panel-custom">
			<ol class="breadcrumb pl-0">
				<li class="breadcrumb-item"><a href="/"><i class="material-icons">home</i> Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('exercise.index')}}">Exercise List</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Exercise</li>
			</ol>
		</nav>
	</div>
	<div class="col-xl-8 col-md-12">
		<div class="ms-panel ms-panel-fh">
			<div class="ms-panel-header">
				<h6>Exercise Form</h6>
			</div>
			<div class="ms-panel-body">
				<form class="needs-validation clearfix" method="POST" action="{{route('exercise.update',$exercise)}}" novalidate enctype="multipart/form-data">
					@csrf
					{{method_field('patch')}}
					<div class="form-row">
						<div class="col-md-12">
							<label for="name">Exercise Name</label>
							<div class="input-group">
								<input type="text" id="name" name="name" class="form-control" placeholder="Exercise Name" value="{{ $exercise->name }}" required>
								<div class="invalid-feedback">
									Please Enter a Name.
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<label for="name_arabic">Exercise Name(in Arabic)</label>
							<div class="input-group">
								<input type="text" id="name_arabic" name="name_arabic" class="form-control" placeholder="اسم التمرين" dir="rtl" value="{{ $exercise->name_arabic }}">
								<div class="invalid-feedback">
									Please Enter a Name.
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-12 mb-3">
							<label for="category">Exercise Category</label>
							<div class="input-group">
								<select class="form-control" name="category" id="category" required>
									<option value="" selected="">Choose Category</option>
									@foreach($categories as $category)
									<option value="{{ $category->id}}" @if($exercise->category == $category->id) selected @endif>{{ $category->name}}</option>
									@endforeach
								</select>
								<div class="invalid-feedback">
									Please select Exercise Category.
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-12">
							<label for="sort">Sort Order</label>
							<div class="input-group">
								<input type="number" class="form-control" name="sort" id="sort" placeholder="Sort Order" value="{{$exercise->sort}}" required>
								<div class="invalid-feedback">
									Please provide a Sort Number.
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-12">
							<label for="time">Time (In Minutes)</label>
							<div class="input-group">
								<input type="number" class="form-control" name="time" id="time" placeholder="Exercise Time" value="{{ $exercise->time}}" required>
								<div class="invalid-feedback">
									Please provide Time.
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-12">
							<label for="calories">Calories Range (in Cal)</label>
							<div class="input-group">
								<input type="text" class="form-control" name="calories" id="calories" placeholder="Calories Range (in Kcal)" value="{{ $exercise->calories}}" required>
								<div class="invalid-feedback">
									Enter Calorie Range.
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<label for="description">Exercise Description</label>
							<div class="input-group">
								<textarea rows="8" id="description" name="description" class="form-control" placeholder="Write about Exercise." required>{{ $exercise->description }}</textarea>
								<div class="invalid-feedback">
									Please Write about Exercise.
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<label for="description_arabic">Exercise Description(in Arabic)</label>
							<div class="input-group">
								<textarea rows="8" id="description_arabic" name="description_arabic" class="form-control" placeholder="اكتب عن التمرين" dir="rtl">{{ $exercise->description_arabic }}</textarea>
								<div class="invalid-feedback">
									Please Write about Exercise.
								</div>
							</div>
						</div>	
						<div class="col-md-12">
							<label for="video">Exercise Video</label>
							<div class="input-group">
								<input type="text" class="form-control" name="video" id="video" placeholder="Youtube Link" value="{{ $exercise->video }}">
								<div class="invalid-feedback">
									Please provide Youtube Video Link
								</div>
							</div>
						</div>	
						<div class="col-md-12">
						<label for="validationCustom12">Upload Image</label>
						<div class="input-group avat">
							<div class="kv-avatar">
								<div class="file-loading">
									<input id="avatar-2" name="image" type="file" class="form-control">
								</div>
							</div>
						</div>
						<div class="kv-avatar-hint">
							<small>Note: File-size should be less than 1.5 MB</small>
						</div>
						<div id="kv-avatar-errors-2" class="center-block mt-3" style="width:336px;display:none"></div>
					</div>					
					</div>
					<button class="btn btn-primary float-right" type="submit">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/js/plugins/piexif.min.js" type="text/javascript"></script>
<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
	This must be loaded before fileinput.min.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/js/plugins/sortable.min.js" type="text/javascript"></script>
<!-- purify.min.js is only needed if you wish to purify HTML content in your preview for 
	HTML files. This must be loaded before fileinput.min.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/js/plugins/purify.min.js" type="text/javascript"></script>
	<!-- the main fileinput plugin file -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/js/fileinput.min.js"></script>
	<!-- optionally if you need a theme like font awesome theme you can include it as mentioned below -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/themes/fas/theme.js"></script>

		<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$("#avatar-2").fileinput({
			theme:'fas',
			overwriteInitial: false,
			maxFileSize: 1500,
			showClose: false,
			showCaption: false,
			showBrowse: false,
			browseOnZoneClick: true,
			removeLabel: '',
			removeIcon: '<i class="flaticon-trash"></i> Remove Image',
			removeTitle: 'Cancel or reset changes',
			elErrorContainer: '#kv-avatar-errors-2',
			msgErrorClass: 'alert alert-block alert-danger',
			defaultPreviewContent: '<img src="/backend/assets/img/media.png" alt="Your Avatar"><h6 class="text-muted">Upload Image</h6>',
			layoutTemplates: {main2: '{preview} {remove} {browse}'},
			allowedFileExtensions: ["jpg", "png", "gif"],
			@if(isset($exercise->image))
			initialPreview: [
			"{{asset('uploads/exercises/'.$exercise->image)}}"
			],
			 initialPreviewAsData: true, // defaults markup

    initialPreviewFileType: 'image', // image is the default and can be overridden in config below
    initialPreviewConfig: [
    {caption: "{{$exercise->image}}", url: "{{route('exercise-image-delete',$exercise)}}", key: {{$exercise->id}} }
    ],
    @endif
});
</script>
@endpush