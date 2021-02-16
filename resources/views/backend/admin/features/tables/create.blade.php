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
				<li class="breadcrumb-item"><a href="{{ url()->previous() }}">Meal List</a></li>
				<li class="breadcrumb-item active" aria-current="page">Add Meal</li>
			</ol>
		</nav>
	</div>
	<div class="col-xl-8 col-md-12">
		<div class="ms-panel ms-panel-fh">
			<div class="ms-panel-header">
				<h6>Meal Form</h6>
			</div>
			<div class="ms-panel-body">
				<form class="needs-validation clearfix" method="POST" action="{{route('meals.store')}}" novalidate enctype="multipart/form-data">
					@csrf
					<div class="form-row">
						<div class="col-md-12">
							<label for="name">Food Name</label>
							<div class="input-group">
								<input type="text" id="name" name="food" class="form-control" placeholder="Food Name" required>
								<div class="invalid-feedback">
									Please Enter a Name.
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<label for="food_arabic">Food Name(in Arabic)</label>
							<div class="input-group">
								<input type="text" id="food_arabic" name="food_arabic" class="form-control" placeholder="Food Name(in Arabic)" value="">
								<div class="invalid-feedback">
									Please Enter a Name(in Arabic).
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-12 mb-3">
							<label for="table">Select Table</label>
							<div class="input-group">
								<select class="form-control" name="table" id="table" required>
									<option value="" selected="">Choose Table</option>
									@foreach($tables as $table)
									<option value="{{ $table->id}}">{{ $table->name}}</option>
									@endforeach
								</select>
								<div class="invalid-feedback">
									Please selectTable.
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-12 mb-3">
							<label for="type">Select Type</label>
							<div class="input-group">
								<select class="form-control" name="type" id="type" required>
									<option value="" selected="">Choose Type</option>
									<option value="breakfast">Breakfast</option>
									<option value="snacks">Snacks</option>
									<option value="lunch">Lunch</option>
									<option value="dinner">Dinner</option>
								</select>
								<div class="invalid-feedback">
									Please select Type.
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<label for="quantity">Quantity</label>
							<div class="input-group">
								<input type="number" class="form-control" name="quantity" id="quantity" placeholder="Quantity (If Applicable)">
							</div>
						</div>	
						<div class="col-md-6">
							<label for="weight">Weight (In gm)</label>
							<div class="input-group">
								<input type="number" class="form-control" name="weight" id="weight" placeholder="Weight (In gm)">
								<div class="invalid-feedback">
									Please provide Weight.
								</div>
							</div>
						</div>	
						<div class="col-md-12">
							<label for="spoon">Spoon</label>
							<div class="input-group">
								<input type="number" class="form-control" name="spoon" id="spoon" placeholder="Spoon" required>
							</div>
						</div>	
						<div class="col-xl-6 col-md-12">
							<label for="calories">Calories Range (in Cal)</label>
							<div class="input-group">
								<input type="number" class="form-control" name="calories" id="calories" placeholder="Calories Range (in Cal)" required>
								<div class="invalid-feedback">
									Enter Calorie Range.
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-12">
							<label for="carbs">Carbs (In gm)</label>
							<div class="input-group">
								<input type="text" class="form-control" name="carbs" id="carbs" placeholder="Carbs (In gm)" required>
								<div class="invalid-feedback">
									Please provide Carbs.
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<label for="fat">Fat (In gm)</label>
							<div class="input-group">
								<input type="text" class="form-control" name="fat" id="fat" placeholder="Fat (In gm)" required>
								<div class="invalid-feedback">
									Please provide Fat.
								</div>
							</div>
						</div>	
						<div class="col-md-6">
							<label for="protein">Protein (In gm)</label>
							<div class="input-group">
								<input type="text" class="form-control" name="protein" id="protein" placeholder="Protein (In gm)" required>
								<div class="invalid-feedback">
									Please provide Protein.
								</div>
							</div>
						</div>	
						<div class="col-xl-12 col-md-12">
							<label for="sort">Sort Order</label>
							<div class="input-group">
								<input type="number" class="form-control" name="sort" id="sort" placeholder="Sort Order" value="" required>
								<div class="invalid-feedback">
									Please provide a Sort Number.
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
@endpush