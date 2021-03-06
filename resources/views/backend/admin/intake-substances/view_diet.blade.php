@extends('layouts.app')
@section('head')
<link href="{{asset('backend/assets/css/datatables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2> Intake Substances</h2>
			<a style="float: right;margin-top: -20px" href="{{ url(Session::get('back_intake_url')) }}" class="ms-btn-icon btn-square btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i></a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="form-group">
			<strong>serving_size:</strong>
			{{ $intake_subs->serving_size }}
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="form-group">
			<strong>Grams_per_serving:</strong>
			{{ $intake_subs->grams_per_serving }}
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="form-group">
			<strong>Diet_type:</strong>
			{{ $intake_subs->diet_type }}
		</div>
	</div>
	@if($intake_subs->images)
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="form-group">
			<strong>Images:</strong>
		</div>
	</div>
	@foreach($intake_subs->images as $data)
	<div class="col-xs-2 col-sm-2 col-md-2">
		<div class="form-group">
			 <img src="{{asset('uploads/substances/'.$data->image)}}" alt="profile Pic" height="200" width="200">
		</div>
	</div>
	@endforeach
	@endif
</div>
@endsection