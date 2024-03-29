@extends('layouts.app')
@section('head')
<style type="text/css">
	.boxes {
 height: 355px;
 overflow: auto;
 width: 400px;
}
</style>
@endsection
@section('content')
<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2>Edit Role</h2>
		</div>
		<div class="pull-right">
			<a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
		</div>
	</div>
</div>
@if (count($errors) > 0)
<div class="alert alert-danger">
	<strong>Whoops!</strong> There were some problems with your input.<br><br>
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="form-group">
			<strong>Name:</strong>
			{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12">
			<strong>Permission:</strong>
			<input type="checkbox" id="select-all" /> Select All<br/>
			<br/>
			<br/>
		<div class="form-group boxes">
			@foreach($permission as $value)
			<label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
				{{ $value->name }}</label>
				<br/>
				@endforeach
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 text-center">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</div>
	{!! Form::close() !!}
	@endsection
	@push('scripts')
<script>
// Listen for click on toggle checkbox
$('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
});
</script>
@endpush