@extends('layouts.app')
@section('head')
<link href="{{asset('backend/assets/css/datatables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb " class="ms-panel-custom">
            <ol class="breadcrumb pl-0">
                <li class="breadcrumb-item"><a href="/"><i class="material-icons">home</i> Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
            </ol>
        </nav>

        @if ($message = Session::get('success'))
<div class="alert alert-success" role="alert">
    <i class="flaticon-tick-inside-circle"></i> <strong>Well done!</strong> {{ $message }}
</div>
@endif

         @foreach ($errors->all() as $error)

<div class="alert alert-warning" role="alert">
    <i class="flaticon-alert"></i> <strong>Warning!</strong> {{ $error }}</div>

@endforeach
        {{-- @include('backend.admin.includes.flashmessage') --}}
    </div>
    <div class="col-md-12">
        <div class="ms-panel">
            <div class="ms-panel-header">
                <h6>Change Password</h6>
            </div>
            <div class="ms-panel-body">
                <div class="card-body">
    <form action="{{ route('auth.change_password') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group {{ $errors->has('current_password') ? 'has-error' : '' }}">
            <label for="current_password">Current password *</label>
            <input type="password" id="current_password" name="current_password" class="form-control" required>
            @if($errors->has('current_password'))
            <em class="invalid-feedback">
                {{ $errors->first('current_password') }}
            </em>
            @endif
        </div>
        <div class="form-group {{ $errors->has('new_password') ? 'has-error' : '' }}">
            <label for="new_password">New password *</label>
            <input type="password" id="new_password" name="new_password" class="form-control" required>
            @if($errors->has('new_password'))
            <em class="invalid-feedback">
                {{ $errors->first('new_password') }}
            </em>
            @endif
        </div>
        <div class="form-group {{ $errors->has('new_password_confirmation') ? 'has-error' : '' }}">
            <label for="new_password_confirmation">New password confirmation *</label>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
            @if($errors->has('new_password_confirmation'))
            <em class="invalid-feedback">
                {{ $errors->first('new_password_confirmation') }}
            </em>
            @endif
        </div>
        <div>
            <input class="btn btn-danger" type="submit" value="Change Password">
        </div>
    </form>


</div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

@endpush