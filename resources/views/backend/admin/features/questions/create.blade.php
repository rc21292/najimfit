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
				<li class="breadcrumb-item active" aria-current="page">Add Question</li>
			</ol>
		</nav>
	</div>
	<div class="col-xl-8 col-md-12">
		<div class="ms-panel ms-panel-fh">
			<div class="ms-panel-header">
				<h6>Question Form</h6>
			</div>
			<div class="ms-panel-body">
				<form class="needs-validation clearfix" method="POST" action="{{route('question.store')}}" novalidate enctype="multipart/form-data">
					@csrf
					<div class="form-row">
						<div class="col-xl-6 col-md-12 mb-3">
							<label for="gender">Select Gender</label>
							<div class="input-group">
								<select class="form-control" name="gender" id="gender" required>
									<option value="both">Both</option>
									<option value="male">Male</option>
									<option value="female">Female</option>
								</select>
								<div class="invalid-feedback">
									Please select a Gender.
								</div>
							</div>
						</div>

						<div class="col-xl-6 col-md-12">
							<label for="sort">Sort Order</label>
							<div class="input-group">
								<input type="number" class="form-control" name="sort" id="sort" placeholder="Sort Order" required value="{{$sort}}">
								<div class="invalid-feedback">
									Please provide a Sort Number.
								</div>
							</div>
						</div>
						

						<div class="col-md-12">
							<label for="question">Question(in English)</label>
							<div class="input-group">
								<textarea rows="5" id="question" name="question" class="form-control" placeholder="Question" required></textarea>
								<div class="invalid-feedback">
									Please Enter a Question.
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<label for="question_arabic">Question(in Arabic)</label>
							<div class="input-group">
								<textarea rows="5" id="question_arabic" dir="rtl" name="question_arabic" class="form-control" placeholder="Question(in Arabic)"></textarea>
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
									<option value="{{$category->id}}">{{ $category->name }}</option>
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
								<input type="text" class="form-control" name="unit" id="unit" placeholder="Unit">
							</div>
						</div>

						<div class="col-md-6">
							<label for="question">Placeholder Text(in English)</label>
							<div class="input-group">
								<input type="text" id="hint" name="hint" class="form-control" placeholder="Placeholder Text" ></input>
								<div class="invalid-feedback">
									Please Enter a Placeholder Text.
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<label for="question_arabic">Placeholder Text(in Arabic)</label>
							<div class="input-group">
								<input type="text" id="arabic_hint" name="arabic_hint" class="form-control" placeholder="Placeholder Text(in Arabic)"></input>
								<div class="invalid-feedback">
									Please Enter a Placeholder Text.
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<label for="question">Question Explanaiton(in English)</label>
							<div class="input-group">
								<input type="text" id="question_explanaiton" value="" name="question_explanaiton" class="form-control" placeholder="Question Explanaiton"></input>
								<div class="invalid-feedback">
									Please Enter a Question Explanaiton.
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<label for="question_arabic">Question Explanaiton(in Arabic)</label>
							<div class="input-group">
								<input type="text" id="arabic_question_explanaiton" value="" name="arabic_question_explanaiton" class="form-control" placeholder="Question Explanaiton(in Arabic)"></input>
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
									<option value="text" >Text</option>
									<option value="number" >Number</option>
									<option value="textarea" >Textarea</option>
									<option value="radio" >Radio</option>
									<option value="checkbox" >Checkbox</option>
									<option value="select" >Select</option>
									<option value="list" >List</option>
									<option value="list_drop" >List Drop</option>
									<option value="Y/N" >Y/N</option>
									<option value="date" >Date</option>
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
									<option value="{{$question_data->id}}">{{ $question_data->question }}</option>
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
								<select class="form-control" name="optional_question" id="optional_question">
									<option value="" >Please Select</option>
									<option value="Yes">Yes</option>
									<option value="No" selected>No</option>					
								</select>
								<div class="invalid-feedback">
									Please select a Question Type.
								</div>
							</div>
						</div>
						<div class="col-xl-12 col-md-12" id="show-hide" style="display: none;">
							<div class="workoutdiv" >
								<form method="post" action="{{route('assign-workout.store')}}">
									@csrf
									<input type="hidden" name="client_id" >
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
														
														<tbody>
															
															<tr id="day-row{{ @$days_row }}">
																<td class="text-right">
																	<input type="text" name="option_name[]" placeholder="Enter Name" class="form-control" />
																</td>
																<td class="text-right">
																	<input type="text" name="option_name_arabic[]" placeholder="Enter Name Arabic" class="form-control" />
																</td>
																<td class="text-center"><button type="button" onclick="$('#day-row{{ @$days_row  }}').remove();" data-toggle="tooltip" title="remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
															</tr>
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
	<script type="text/javascript">	
		var days_row = 0;
		function adddays() {
			html = '<tr id="day-row' + days_row + '">';
			html += '  <th scope="row"><input type="text" name="option_name[]" value="" placeholder="Enter Name" class="form-control"/></th><th scope="row"><input type="text" name="option_name_arabic[]" value="" placeholder="Enter Name Arabic" class="form-control"/></th>';
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