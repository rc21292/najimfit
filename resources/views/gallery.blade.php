@extends('layouts.frontend.app')
@section('head')

<title>Welcome to Tegdar</title>
@endsection
@section('content')
     <!--Categorybanner-Title-->
  <section class="bannercategory">
    <div class="container">
      <div class="bannertitle">
        <h1>   صالة عرض   </h1>
        <p>    الصفحة الرئيسية / صالة عرض   </p>
      </div>
    </div>
  </section>
  <!--Categorybanner-Title-end-->
  <!--Section-Three-Start-->
  <section class="gallery-section">
    <div class="container-fluid">
      <div class="image-gallery">
          <?php $count = 1; ?>
          @foreach($galleries as $gallery)

          @if($count == 1)  
          <ul class="list-inline d-flex"> 
            @endif
        



          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter{{ $gallery->id }}"><img src="{{asset('uploads/gallery/'.$gallery->image)}}" alt="img02" class="img-fluid"></a></li>

          <!-- Modal -->
          <div class="modal fade bd-example-modal-lg my-modal" id="exampleModalCenter{{ $gallery->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="galleryimg">
                    <img src="{{asset('uploads/gallery/popup/'.$gallery->image_popup)}}" alt="img02" class="img-fluid">
                  </div>
                </div>
              </div>
            </div>
          </div>

          @if($count == 5) @php
            $count = 0;
          @endphp </ul>  @endif
@php
            $count++;
          @endphp
          <!-- Modal-End -->
          @endforeach

         {{--  <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset('front_end/image/gallery/galleryimg2.jpg')}}" alt="img02" class="img-fluid"></a></li>
          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset('front_end/image/gallery/galleryimg3.jpg')}}" alt="img02" class="img-fluid"></a></li>
          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset('front_end/image/gallery/galleryimg1.jpg')}}" alt="img02" class="img-fluid"></a></li>
          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset('front_end/image/gallery/galleryimg3.jpg')}}" alt="img02" class="img-fluid"></a></li> --}}
        
        {{-- <ul class="list-inline d-flex">
          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset('front_end/image/gallery/galleryimg4.jpg')}}" alt="img02" class="img-fluid"></a></li>
          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset('front_end/image/gallery/galleryimg5.jpg')}}" alt="img02" class="img-fluid"></a></li>
          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset('front_end/image/gallery/galleryimg6.jpg')}}" alt="img02" class="img-fluid"></a></li>
          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset('front_end/image/gallery/galleryimg4.jpg')}}" alt="img02" class="img-fluid"></a></li>
          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset('front_end/image/gallery/galleryimg6.jpg')}}" alt="img02" class="img-fluid"></a></li>
        </ul>
        <ul class="list-inline d-flex">
          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset('front_end/image/gallery/galleryimg7.jpg')}}" alt="img02" class="img-fluid"></a></li>
          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset('front_end/image/gallery/galleryimg8.jpg')}}" alt="img02" class="img-fluid"></a></li>
          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset('front_end/image/gallery/galleryimg9.jpg')}}" alt="img02" class="img-fluid"></a></li>
          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset('front_end/image/gallery/galleryimg7.jpg')}}" alt="img02" class="img-fluid"></a></li>
          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset('front_end/image/gallery/galleryimg9.jpg')}}" alt="img02" class="img-fluid"></a></li>
        </ul>
        <ul class="list-inline d-flex">
          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset('front_end/image/gallery/galleryimg10.jpg')}}" alt="img02" class="img-fluid"></a></li>
          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset('front_end/image/gallery/galleryimg11.jpg')}}" alt="img02" class="img-fluid"></a></li>
          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset('front_end/image/gallery/galleryimg12.jpg')}}" alt="img02" class="img-fluid"></a></li>
          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset('front_end/image/gallery/galleryimg10.jpg')}}" alt="img02" class="img-fluid"></a></li>
          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset('front_end/image/gallery/galleryimg12.jpg')}}" alt="img02" class="img-fluid"></a></li>
        </ul>
        <ul class="list-inline d-flex">
          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset('front_end/image/gallery/galleryimg13.jpg')}}" alt="img02" class="img-fluid"></a></li>
          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset('front_end/image/gallery/galleryimg14.jpg')}}" alt="img02" class="img-fluid"></a></li>
          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset('front_end/image/gallery/galleryimg15.jpg')}}" alt="img02" class="img-fluid"></a></li>
          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset('front_end/image/gallery/galleryimg13.jpg')}}" alt="img02" class="img-fluid"></a></li>
          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset('front_end/image/gallery/galleryimg15.jpg')}}" alt="img02" class="img-fluid"></a></li>
        </ul> --}}
      </div>
    </div>
    
  </section>
  <!--Section-Three-end-->
@endsection
@push('scripts')
@endpush