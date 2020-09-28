@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2>Role Management</h2>
		</div>
		<div class="float-right pb-2">
			@can('role-create')
			<a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
			@endcan
		</div>
	</div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
	<p>{{ $message }}</p>
</div>
@endif
<table class="table table-bordered">
	<tr>
		<th>No</th>
		<th>Name</th>
		<th width="280px">Action</th>
	</tr>
	@foreach ($roles as $key => $role)
	<tr>
		<td>{{ ++$i }}</td>
		<td>{{ $role->name }}</td>
		<td>
			<a class="ms-btn-icon btn-square btn-info" href="{{ route('roles.show',$role->id) }}"><i class="fa fa-eye"></i></a>
			@can('role-edit')
			<a class="ms-btn-icon btn-square btn-primary" href="{{ route('roles.edit',$role->id) }}"><i class="fa fa-pen"></i></a>
			@endcan
			@can('role-delete')
			{!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
			<button type="submit" class="ms-btn-icon btn-square btn-danger"><i class="fa fa-trash"></i></button>
			{!! Form::close() !!}
			@endcan
		</td>
	</tr>
	@endforeach
</table>
{!! $roles->render() !!}
@endsection