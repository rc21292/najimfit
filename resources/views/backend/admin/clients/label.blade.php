@extends('layouts.app')
@section('head')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="col-xl-12 col-md-12">
	<div class="col-xl-12">
		<div class="ms-panel">
			<div class="ms-panel-body">
				<div class="row">
					<div class="col-md-12">
						<div class="ms-panel">
							<div class="ms-panel-header">
								<h6>Assign Labels to Client</h6>
								
							</div>
							<div class="ms-panel-body">
								<form action="{{route('labels.store')}}" method="post">
									{{csrf_field()}}
									<div class="modal-body">
										<div class="ms-form-group has-icon">
											<label>Select Label(s)</label><br>
											<select class="js-example-basic-multiple" name="labels[]" multiple="multiple" style="width: 100%">
												<option value="High Priority" @foreach($labels as $row) @if($row->label == 'High Priority') selected @endif @endforeach>High Priority</option>
												<option value="Diabetic" @foreach($labels as $row) @if($row->label == 'Diabetic') selected @endif @endforeach>Diabetic</option>
												<option value="Sick" @foreach($labels as $row) @if($row->label == 'Sick') selected @endif @endforeach>Sick</option>
											</select>
										</div>
									{{-- 	<div class="ms-form-group has-icon">
											<label>Customize Label</label>
											<input type="text" placeholder="Customize Label" class="form-control" name="customized_lable" value="">
											<i class="fa fa-sort"></i>
										</div> --}}
										<input type="hidden" id="client" name="client_id" value="{{$id}}">
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.js-example-basic-multiple').select2({
			tags: true,
			tokenSeparators: [',', ' ']
		});
	});
</script>
@endpush
