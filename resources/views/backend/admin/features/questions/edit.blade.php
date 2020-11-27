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
				<li class="breadcrumb-item"><a href="{{ route('question.index')}}">Question List</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Question</li>
			</ol>
		</nav>
	</div>
	<div class="col-xl-8 col-md-12">
		<div class="ms-panel ms-panel-fh">
			<div class="ms-panel-header">
				<h6>Question Form</h6>
			</div>
			<div class="ms-panel-body">
				<form class="needs-validation clearfix" method="POST" action="{{route('question.update',$question)}}" novalidate enctype="multipart/form-data">
					@csrf
					{{ method_field('PUT') }}
					<div class="form-row">
						<div class="col-xl-6 col-md-12 mb-3">
							<label for="gender">Select Gender</label>
							<div class="input-group">
								<select class="form-control" name="gender" id="gender" required>
									<option value="both" @if($question->gender == 'both') selected @endif>Both</option>
									<option value="male" @if($question->gender == 'male') selected @endif>Male</option>
									<option value="female" @if($question->gender == 'female') selected @endif>Female</option>
								</select>
								<div class="invalid-feedback">
									Please select a Gender.
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-12">
							<label for="sort">Sort Order</label>
							<div class="input-group">
								<input type="number" class="form-control" name="sort" id="sort" placeholder="Sort Order" required value="{{$question->sort}}">
								<div class="invalid-feedback">
									Please provide a Sort Number.
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<label for="question">Question(in English)</label>
							<div class="input-group">
								<textarea rows="5" id="question" name="question" class="form-control" placeholder="Question" required>{{$question->question}}</textarea>
								<div class="invalid-feedback">
									Please Enter a Question.
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<label for="question_arabic">Question(in Arabic)</label>
							<div class="input-group">
								<textarea rows="5" id="question_arabic" dir="rtl" name="question_arabic" class="form-control" placeholder="Question(in Arabic)">{{$question->question_arabic}}</textarea>
								<div class="invalid-feedback">
									Please Enter a Question.
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-12 mb-3">
							<label for="category">Select Category</label>
							<div class="input-group">
								<select class="form-control" name="category" id="category" required>
									@foreach($categories as $category)
									<option value="{{$category->id}}" @if($question->category == $category->id) selected @endif>{{ $category->name }}</option>
									@endforeach
								</select>
								<div class="invalid-feedback">
									Please select a Category.
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-12">
							<label for="sort">Units</label>
							<div class="input-group">
								<input type="text" class="form-control" name="unit" id="unit" value="{{$question->unit}}" placeholder="Unit">
							</div>
						</div>

						<div class="col-md-6">
							<label for="question">Placeholder Text(in English)</label>
							<div class="input-group">
								<input type="text" id="hint" value="{{$question->hint}}" name="hint" class="form-control" placeholder="Placeholder Text"></input>
								<div class="invalid-feedback">
									Please Enter a Placeholder Text.
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<label for="question_arabic">Placeholder Text(in Arabic)</label>
							<div class="input-group">
								<input type="text" id="arabic_hint" value="{{$question->arabic_hint}}" name="arabic_hint" class="form-control" placeholder="Placeholder Text(in Arabic)"></input>
								<div class="invalid-feedback">
									Please Enter a Placeholder Text.
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<label for="question">Question Explanaiton(in English)</label>
							<div class="input-group">
								<input type="text" id="question_explanaiton" value="{{$question->question_explanaiton}}" name="question_explanaiton" class="form-control" placeholder="Question Explanaiton"></input>
								<div class="invalid-feedback">
									Please Enter a Question Explanaiton.
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<label for="question_arabic">Question Explanaiton(in Arabic)</label>
							<div class="input-group">
								<input type="text" id="arabic_question_explanaiton" value="{{$question->arabic_question_explanaiton}}" name="arabic_question_explanaiton" class="form-control" placeholder="Question Explanaiton(in Arabic)"></input>
								<div class="invalid-feedback">
									Please Enter a Question Explanaiton.
								</div>
							</div>
						</div>

						<div class="col-xl-6 col-md-12 mb-3">
							<label for="question_type">Select Question Type</label>
							<div class="input-group">
								<select class="form-control" name="question_type" id="question_type" required>
									<option value="" >Please Select</option>
									<option value="text" @if(@$question->question_type == 'text') selected @endif >Text</option>
									<option value="number" @if(@$question->question_type == 'number') selected @endif >Number</option>
									<option value="textarea" @if(@$question->question_type == 'textarea') selected @endif >Textarea</option>
									<option value="radio" @if(@$question->question_type == 'radio') selected @endif >Radio</option>
									<option value="checkbox" @if(@$question->question_type == 'checkbox') selected @endif >Checkbox</option>
									<option value="select" @if(@$question->question_type == 'select') selected @endif >Select</option>
									<option value="list" @if(@$question->question_type == 'list') selected @endif >List</option>
									<option value="Y/N" @if(@$question->question_type == 'Y/N') selected @endif >Y/N</option>
									<option value="list_drop"  @if(@$question->question_type == 'list_drop') selected @endif >List Drop</option>
									<option value="date" @if(@$question->question_type == 'date') selected @endif>Date</option>
								</select>
								<div class="invalid-feedback">
									Please select a Question Type.
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-12 mb-3">
							<label for="question_type">Select Related Question</label>
							<div class="input-group">
								<select class="form-control" name="related_question" id="related_question" required>
									<option value="" >Please Select</option>
									@foreach($questions as $question_data)
									<option value="{{$question_data->id}}" @if($question->related_question == $question_data->id) selected @endif>{{ $question_data->question }}</option>
									@endforeach
								</select>
								<div class="invalid-feedback">
									Please select a Question Type.
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-12 mb-3">
							<label for="optional_question">Question is Optional</label>
							<div class="input-group">
								<select class="form-control" name="optional_question" id="optional_question" required>
									<option value="" >Please Select</option>
									<option value="Yes" @if(@$question->optional_question == 'Yes') selected @endif >Yes</option>
									<option value="No" @if(@$question->optional_question == 'No') selected @endif >No</option>					
								</select>
								<div class="invalid-feedback">
									Please select a Question Type.
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-12">
						</div>
						
						<div class="col-xl-12 col-md-12" id="show-hide" @if(($question->question_type == 'select') || ($question->question_type == 'radio') || ($question->question_type == 'checkbox') || ($question->question_type == 'list_drop') || ($question->question_type == 'Y/N')) style="display: block;" @else style="display: none;" @endif >
							<div class="pt-5 workoutdiv" >
								<form method="post" action="{{route('assign-workout.store')}}">
									@csrf
									<input type="hidden" name="client_id" >
									<div class="col-xl-12 col-md-12">
										<div class="ms-panel ms-panel-fh">
											<div class="ms-panel-header">
												<h6>Options</h6>
											</div>
											<div class="ms-panel-body">
												<div class="table">
													<table id="days" class="table thead-primary">
														<thead>
															<tr>
																<th scope="col">Option Name</th>
																<th scope="col">Option Name Arabic</th>
																<th scope="col">Action</th>
															</tr>
														</thead>

														@php

														$days_row = 0;

														$question_options = DB::table('question_options')
														->select('id','name','name_arabic')
														->where('question_id',$question->id)
														->get();
														@endphp
														
														<tbody>
															@foreach($question_options as $options)
															<tr id="day-row{{ @$days_row }}">
																<td class="text-right">
																	<input type="hidden" name="option_id[]" value="{{$options->id}}"/>
																	<input type="text" name="option_name[]" value="{{$options->name}}" placeholder="Enter Name" class="form-control" /></td>
																	<td class="text-right">
																	<input type="text" name="option_name_arabic[]" value="{{$options->name_arabic}}" placeholder="Enter Name Arabic" class="form-control" /></td>
																
																<td class="text-center"><button type="button" onclick="$('#day-row{{ @$days_row  }}').remove();" data-toggle="tooltip" title="remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
															</tr>
															@php
															$days_row ++;
															@endphp
															@endforeach
														</tbody>
														<tfoot>
															<tr>
																<th scope="row"></th>
																<td></td>
																<td class="text-center"><button type="button" onclick="adddays();" data-toggle="tooltip" title="Add Option Value" class="btn btn-danger"><i class="fa fa-plus"></i></button></td></td>
															</tr>
														</tfoot>
													</table>
												</div>
											</div>
										</div>
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
			@if(isset($question->image))
			initialPreview: [
			"{{asset('uploads/questions/'.$question->image)}}"
			],
			 initialPreviewAsData: true, // defaults markup

    initialPreviewFileType: 'image', // image is the default and can be overridden in config below
    initialPreviewConfig: [
    {caption: "{{$question->image}}", url: "{{route('question-image-delete',$question)}}", key: {{$question->id}} }
    ],
    @endif
});
</script>
<script type="text/javascript">
		var days_row = 0;
		function adddays() {
			html = '<tr id="day-row' + days_row + '">';
			html += '  <th scope="row"><input type="hidden" name="option_id[]" value="0"><input type="text" name="option_name[]" value="" placeholder="Enter Name" class="form-control" required/></th>';
			html += '  <th scope="row"><input type="text" name="option_name_arabic[]" value="" placeholder="Enter Name Arabic" class="form-control" required/></th>';
			html += '  <td class="text-center"><button type="button" onclick="$(\'#day-row' + days_row + '\').remove();" data-toggle="tooltip" title="remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
			html += '</tr>';

			$('#days tbody').append(html);
			days_row++;
		}   

		$('#question_type').change(function() {
			if (($(this).val() == 'radio') || ($(this).val() == 'checkbox') || ($(this).val() == 'select') || ($(this).val() == 'list_drop') || ($(this).val() == 'Y/N')) {
				$("#show-hide").show();
			}else{
				$("#show-hide").hide();
			}
		});         

	</script>
@endpush