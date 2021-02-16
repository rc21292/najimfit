@extends('layouts.app') 
@section('head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<style type="text/css">
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
	.btn{
		min-width: 0px;
	}
</style>
@endsection
@section('content')
<div class="col-xl-7 col-md-12">
	<div class="ms-panel ms-panel-fh">
		<div class="ms-panel-header">
			<div class="row">
				<div class="col-sm-9">
					<h5>My Profile</h5>
				</div>
				<div class="col-sm-3">
					<a class="btn btn-danger" href="{{route('my-account.index')}}"><i class="fas fa-arrow-circle-left pr-2"></i> REFRESH</a>
				</div>
			</div>
		</div>
		<div class="ms-panel-body text-center">
			<form class="needs-validation clearfix" action="{{route('my-account.store')}}" method="POST" novalidate="" enctype="multipart/form-data">
				@csrf
				<div class="form-row">
					<div class="col-md-12">
						<label for="validationCustom10">Name</label>
						<div class="input-group">
							<input type="text" class="form-control" name="name" id="validationCustom10" placeholder="Name" required="" value="{{$profile['name']}}">	
							<div class="invalid-feedback" >
								Enter Name
							</div>							
						</div>
					</div>				
					<div class="col-md-12">
						<label for="validationCustom11">Email</label>
						<div class="input-group">
							<input type="email" class="form-control" name="sort" id="validationCustom11" placeholder="Sort Order" required="" value="{{$profile['email']}}" disabled>
						</div>
					</div>
					<div class="col-md-12">
						<label for="tagline">Tagline</label>
						<div class="input-group">
							<input type="text" rows="8" id="tagline" name="tagline" class="form-control" placeholder="Write Tagline." required value="{{ $profile['tagline'] }}" >
							<div class="invalid-feedback">
								Please Write Tagline.
							</div>
						</div>
					</div>	

					<div class="col-md-12">
						<label for="tagline_arabic">Tagline(in Arabic)</label>
						<div class="input-group">
							<input type="text" rows="8" id="tagline_arabic" name="tagline_arabic" class="form-control" placeholder="Write Tagline(in Arabic)." required value="{{ $profile['tagline_arabic'] }}" >
							<div class="invalid-feedback">
								Please Write Tagline(in Arabic).
							</div>
						</div>
					</div>	
					<div class="col-md-12">
						<label for="description">Description</label>
						<div class="input-group">
							<textarea rows="8" id="description" name="description" class="form-control" placeholder="Write Description." required>{{ $profile['description'] }}</textarea>
							<div class="invalid-feedback">
								Please Write Description.
							</div>
						</div>
					</div>	
					<div class="col-md-12">
						<label for="description_arabic">Description(in Arabic)</label>
						<div class="input-group">
							<textarea rows="8" id="description_arabic" dir="rtl" name="description_arabic" class="form-control" placeholder="Write Description(in Arabic)">{{$profile['description_arabic']}}</textarea>
							<div class="invalid-feedback">
								Please Write Description.
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<label for="facebook_link">Facebook Link</label>
						<div class="input-group">
							<input type="text" rows="8" id="facebook_link" name="facebook_link" class="form-control" placeholder="Write Facebook Link." value="{{ $profile['facebook_link'] }}" >
							<div class="invalid-feedback">
								Please Write Facebook Link.
							</div>
						</div>
					</div>	
					<div class="col-md-12">
						<label for="twitter_link">Twitter Link</label>
						<div class="input-group">
							<input type="text" rows="8" id="twitter_link" name="twitter_link" class="form-control" placeholder="Write Twitter Link." value="{{ $profile['twitter_link'] }}" >
							<div class="invalid-feedback">
								Please Write Twitter Link.
							</div>
						</div>
					</div>	
					<div class="col-md-12">
						<label for="instagarm_link">Instagram Link</label>
						<div class="input-group">
							<input type="text" rows="8" id="instagarm_link" name="instagarm_link" class="form-control" placeholder="Write Instagram Link." value="{{ $profile['instagarm_link'] }}" >
							<div class="invalid-feedback">
								Please Write Instagram Link.
							</div>
						</div>
					</div>	
					<div class="col-md-12">
						<label for="youtube_link">Youtube Link</label>
						<div class="input-group">
							<input type="text" rows="8" id="youtube_link" name="youtube_link" class="form-control" placeholder="Write Youtube Link." value="{{ $profile['youtube_link'] }}" >
							<div class="invalid-feedback">
								Please Write Youtube Link.
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
				<input class="btn btn-warning" type="submit" value="Submit">
			</form>
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
			allowedFileExtensions: ["jpg", "png", "gif", "jpeg"],
			@if(isset($profile->avatar))
			initialPreview: [
			"{{asset('uploads/user/'.$profile->avatar)}}"
			],
			 initialPreviewAsData: true, // defaults markup

    initialPreviewFileType: 'image', // image is the default and can be overridden in config below
    initialPreviewConfig: [
    {caption: "{{$profile->avatar}}", url: "{{route('account-delete-image',$profile)}}", key: {{$profile->id}} }
    ],
    @endif
});
</script>
@endpush