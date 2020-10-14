@extends('layouts.app')
@section('head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/css/bootstrap-formhelpers.css">
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
				<li class="breadcrumb-item"><a href="{{ route('package.index')}}">Package List</a></li>
				<li class="breadcrumb-item active" aria-current="page">Add Package</li>
			</ol>
		</nav>
	</div>

		<!-- Nav tabs -->

		<div class="ms-panel ms-panel-fh" style="width: 100%">
			<div class="ms-panel-header">
				<h6>Package Form</h6>
			</div>

			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><span class="bfh-languages" data-language="en_US" data-flags="true"></span></a></li>
				<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Arabic</a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="home"><div class="col-xl-8 col-md-12">
					<div class="ms-panel-body">
						<form class="needs-validation clearfix" method="POST" action="{{route('package.store')}}" enctype="multipart/form-data">
							@csrf
							<div class="form-row">
								<div class="col-md-12">
									<label for="name">Package Name</label>
									<div class="input-group">
										<input type="text" id="name" name="name" class="form-control" placeholder="Package Name" required>
										<div class="invalid-feedback">
											Please Enter a Name.
										</div>
									</div>
								</div>
								<div class="col-xl-6 col-md-12 mb-3">
									<label for="includes">Package Includes</label>
									<div class="input-group">
										<select class="form-control" name="includes" id="includes" required>
											<option value="both">Both Workout & Diet</option>
											<option value="workout">Workout Only</option>
											<option value="diet">Diet Only</option>
										</select>
										<div class="invalid-feedback">
											Please select what your Package Includes.
										</div>
									</div>
								</div>
								<div class="col-xl-6 col-md-12">
									<label for="sort">Sort Order</label>
									<div class="input-group">
										<input type="number" class="form-control" name="sort" id="sort" placeholder="Sort Order" required>
										<div class="invalid-feedback">
											Please provide a Sort Number.
										</div>
									</div>
								</div>
								<div class="col-xl-6 col-md-12">
									<label for="price">Package Price</label>
									<div class="input-group">
										<input type="number" class="form-control" name="price" id="price" placeholder="Package Price" required>
										<div class="invalid-feedback">
											Please provide a Sort Number.
										</div>
									</div>
								</div>
								<div class="col-xl-6 col-md-12">
									<label for="validity">Package Validity (In Days)</label>
									<div class="input-group">
										<input type="text" class="form-control" name="validity" id="validity" placeholder="Package Validity (In Days)" required>
										<div class="invalid-feedback">
											Enter Validity For Package.
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<label for="targets">Package Targets</label>
									<div class="input-group">
										<textarea rows="5" id="targets" name="target" class="form-control" placeholder="Write about those people for whom this Package is adviced." required></textarea>
										<div class="invalid-feedback">
											Please Write about those people for whom this Package is adviced.
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<label for="description">Package Description</label>
									<div class="input-group">
										<textarea rows="8" id="description" name="description" class="form-control" placeholder="Write about Package." required></textarea>
										<div class="invalid-feedback">
											Please Write about Package.
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
										<small>Note: File-size should be less than 3.5 MB</small>
									</div>
									<div id="kv-avatar-errors-2" class="center-block mt-3" style="width:336px;display:none"></div>
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
			<div role="tabpanel" class="tab-pane" id="profile">
				<div class="col-xl-8 col-md-12">
					<div class="ms-panel ms-panel-fh">
						<div class="ms-panel-body">
							<div class="form-row">
								<div class="col-md-12">
									<label for="name">Package Name</label>
									<div class="input-group">
										<input type="text" dir="rtl" id="name" name="name_arabic" dir="rtl" class="form-control" placeholder="اسم الحزمة">
										<div class="invalid-feedback">
											Please Enter a Name.
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<label for="targets">Package Targets</label>
									<div class="input-group">
										<textarea rows="5" id="targets" dir="rtl" name="target_arabic" class="form-control" placeholder="Write about those people for whom this Package is adviced."></textarea>
										<div class="invalid-feedback">
											Please Write about those people for whom this Package is adviced.
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<label for="description">Package Description</label>
									<div class="input-group">
										<textarea rows="8" id="description" dir="rtl" name="description_arabic" class="form-control" placeholder="Write about Package."></textarea>
										<div class="invalid-feedback">
											Please Write about Package.
										</div>
									</div>
								</div>		
							</div>
							<button class="btn btn-primary float-right" type="submit">Save</button>
						</form>
					</div>
				</div>
			</div></div>
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
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.min.js"></script>
	<script>

		$("#avatar-2").fileinput({
			theme:'fas',
			overwriteInitial: false,
			maxFileSize: 3500,
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
			allowedFileExtensions: ["jpg", "png", "gif"]
		});
	</script>
	@endpush