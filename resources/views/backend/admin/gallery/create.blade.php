@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb " class="ms-panel-custom">
            <ol class="breadcrumb pl-0">
                <li class="breadcrumb-item"><a href="/"><i class="material-icons">home</i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('gallery.index')}}">Gallery</a></li>
                <li class="breadcrumb-item active" aria-current="page">Image Gallery Create</li>
            </ol>
        <a href="{{ route('gallery.index') }}" class="ms-btn-icon btn-square btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i></a> 
        </nav>
    </div>  
    <div class="col-xl-8 col-md-12">
        <div class="ms-panel ms-panel-fh">
            <div class="ms-panel-header">
                <h6>Image Gallery Form</h6>
            </div>
            <div class="ms-panel-body">
                <form class="needs-validation clearfix" method="POST" action="{{route('gallery.store')}}" enctype="multipart/form-data" novalidate>

                    @csrf
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


        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        @endif
                    <div class="form-row">
                        <div class="col-xl-12 col-md-12 mb-3">
                            <label for="title">Title</label>
                            <div class="input-group">
                                <input type="text" id="title" name="title" class="form-control" placeholder="Title" required>
                                <div class="invalid-feedback">
                                    Please Enter a Title.
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12 mb-3">
                            <label for="image">Image</label>
                            <div class="input-group">
                                <input type="file" name="image" class="form-control" required="">
                                <div class="invalid-feedback">
                                    Please Select Image.
                                </div>
                            </div>
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