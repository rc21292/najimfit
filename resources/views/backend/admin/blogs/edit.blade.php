@extends('layouts.app')
@section('head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/css/bootstrap-formhelpers.css">
<style>
    input {
        text-align: center;
    }
    .select2-selection {
        height: 38px !important;
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
                <li class="breadcrumb-item"><a href="{{ route('blogs.index')}}">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog Edit</li>
            </ol>
            <a href="{{ route('blogs.index') }}" class="ms-btn-icon btn-square btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i></a> 
        </nav>
    </div>

    <!-- Nav tabs -->

    <div class="ms-panel ms-panel-fh" style="width: 100%">
        <div class="ms-panel-header">
            <h6>Blog Edit Form</h6>
        </div>


        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home"><div class="col-xl-8 col-md-12">
            <div class="ms-panel-body">                
                <form class="needs-validation clearfix" method="POST" action="{{route('blogs.update',$blog->id)}}" enctype="multipart/form-data">
                    @csrf
                        {{ method_field('PUT') }}
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="title">Title</label>
                            <div class="input-group">
                                <input type="text" id="title" name="title" value="{{ $blog->title }}" class="form-control" placeholder="Title" required>
                                <div class="invalid-feedback">
                                    Please Enter a Name.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="title">Title(in Arabic)</label>
                            <div class="input-group">
                                <input type="text" dir="rtl" id="title" name="title_arabic" value="{{ $blog->title_arabic }}" dir="rtl" class="form-control" placeholder="اسم الحزمة">
                                <div class="invalid-feedback">
                                    Please Enter a Title.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="description">Description</label>
                            <div class="input-group">
                                <textarea rows="8" id="description" name="description" class="form-control" placeholder="Description" required>{{ $blog->description }}</textarea>
                                <div class="invalid-feedback">
                                    Please Write Description 
                                </div>
                            </div>
                        </div> 


                        <div class="col-md-6">
                            <label for="description">Description(in Arabic)</label>
                            <div class="input-group">
                                <textarea rows="8" id="description" dir="rtl" name="description_arabic" class="form-control" placeholder="أدخل الوصف">{{ $blog->description_arabic }}</textarea>
                                <div class="invalid-feedback">
                                    Please Write Description.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
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
                        {{-- <div class="col-md-12 pt-4">
                            <label class="ms-switch">
                                <input type="checkbox" checked="" name="status">
                                <span class="ms-switch-slider ms-switch-primary square"></span>
                            </label>
                            <span> Enable </span>
                        </div>   --}}                
                    </div>
                    <button class="btn btn-primary float-right" type="submit">Save</button>
                </form>

            </div>
        </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.min.js"></script>
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
            @if(isset($blog->image))
            initialPreview: [
            "{{asset('uploads/blogs/'.$blog->image)}}"
            ],
             initialPreviewAsData: true, // defaults markup

    initialPreviewFileType: 'image', // image is the default and can be overridden in config below
    initialPreviewConfig: [
    {caption: "{{$blog->image}}", url: "{{route('blog-image-delete',$blog->id)}}", key: {{$blog->id}} }
    ],
    @endif
});
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });
    });
</script>
    @endpush