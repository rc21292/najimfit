@extends('layouts.app')
@section('head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

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

<div class="col-xl-12 col-md-12">
	<div class="col-xl-12">
		<div class="alert alert-success alertdis" style="display:none"></div>
		<div class="ms-panel">
			<div class="ms-panel-body">
				<div class="row">
					<div class="col-sm-2 pt-2">
						<p><img class="rounded-circle" src='https://via.placeholder.com/40x40' style='width:40px; height:40px;'> {{$client->firstname}} {{$client->lastname}}</p>
					</div>
					<div class="col-sm-2 pt-3">
						<p>ID: NJMF{{$client->id}}</p>
					</div>
					<div class="col-sm-2 pt-3">
						<p>Gender: {{ucfirst($client->gender)}}</p>
					</div>
					<div class="col-sm-2 pt-3">
						<p>Age: 26 Yr</p>
					</div>
					<div class="col-sm-2 pt-3">
						<p>Weight: {{ $weight }}</p>
					</div>
					<div class="col-sm-2 pt-3">
						<p>Height: {{ $height }}
						<a style="float: right;margin-top: -10px" href="{{ URL::previous() }}" class="ms-btn-icon btn-square btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i></a></p>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-9">
				<div class="ms-panel ms-panel-body text-center">
					<form class="needs-validation clearfix" action="{{route('client-full-profile.update',$profile->id)}}" method="POST" novalidate="" enctype="multipart/form-data">
						@csrf
						{{ method_field('PUT') }}
						<div class="form-row">
							<div class="col-md-12">
								<label for="validationCustom10">Name</label>
								<div class="input-group">
									<input type="text" class="form-control" name="firstname" id="validationCustom10" placeholder="Name" required="" value="{{$profile['firstname']}}">	
									<div class="invalid-feedback" >
										First Name
									</div>							
								</div>
							</div>
							<div class="col-md-12">
								<label for="validationCustom10">Last Name</label>
								<div class="input-group">
									<input type="text" class="form-control" name="lastname" id="validationCustom10" placeholder="Name" required="" value="{{$profile['lastname']}}">	
									<div class="invalid-feedback" >
										Last Name
									</div>							
								</div>
							</div>
							<div class="col-md-12">
								<label for="validationCustom11">Email</label>
								<div class="input-group">
									<input type="email" class="form-control" name="email" id="validationCustom11" placeholder="Sort Order" required="" value="{{$profile['email']}}">
								</div>
							</div>
							<div class="col-xl-12 col-md-12 mb-3">
								<label for="gender">Gender</label>
								<div class="input-group">
									<select id="gender" name="gender" class="form-control" placeholder="Password" required>
										<option value="" selected>Choose Gender</option>
										<option value="male" @if($client->gender == 'male') selected @endif>Male</option>
										<option value="female" @if($client->gender == 'female') selected @endif>Female</option>
									</select>
									<div class="invalid-feedback">
										Please Select Gender.
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
						<input class="btn btn-warning" type="submit" value="Update">
					</form>
				</div>

				<div class="ms-panel">
					<div class="col-md-12">

						<table class="table ms-profile-information">
							<tbody>
								<tr><th scope="row"><input type="checkbox" id="blockuser" @if($profile['blocked_from_app']) @else checked @endif data-toggle="toggle" data-on="Block User" data-off="Unblock User" data-onstyle="success" data-offstyle="danger"></th></tr>
								<tr>
									<th scope="row">Active Package</th>
									<td>{{@$client_package->name}}</td>
								</tr>
								<tr>
									@php
									$today = date("Y-m-d");
									if($client->validity >= $today){
										$days = 'remaining';
									}else{
										$days = 'expired';
									}
									@endphp
									<th scope="row">Package valid Upto</th>
									<td>@if($days == 'remaining')<span class="badge badge-primary">{{ $client->validity }} @elseif($days == 'expired') <span class="badge badge-danger"> Expired @endif</span></td>
								</tr>

									<tr>
										<th scope="row"></th>
										<td></td>
									</tr>

								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-sm-3" style="border: 1px dotted #00ff08;">
					<h5 class="text-center pb-3">Questionnaire</h5>
					@foreach($answers as $answer)
					<p>Q: {{ $answer->question }} <p>
						<p>A: {{ $answer->answer }}</p>
						@endforeach
					</div>
				</div>
				@endsection
				@push('scripts')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
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
			@if(isset($profile->avater))
			initialPreview: [
			"{{asset('uploads/user/'.$profile->avater)}}"
			],
			 initialPreviewAsData: true, // defaults markup

    initialPreviewFileType: 'image', // image is the default and can be overridden in config below
    initialPreviewConfig: [
    {caption: "{{$profile->avater}}", url: "{{route('account-image-delete',$profile->avater)}}", key: {{$profile->id}} }
    ],
    @endif
});

		$('#blockuser').change(function(e){
			if($(this).prop('checked'))
			{
				var value = 0;
			}
			else
			{
				value = 1;
			}
			e.preventDefault();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': "{{csrf_token()}}"
				}
			});
			$.ajax({
				url: "{{ route('block-unblock-user') }}",
				method: 'post',

				data: {
					value: value,
					client_id: "{{ $profile['id'] }}",
				},
				success: function(result){
					$('.alertdis').show();
					$('.alertdis').html(result.success);
					 $(window).scrollTop(0);
				}});
		});

</script>
@endpush