@extends('layouts.frontend.app')
@section('head')
<title>Welcome to Tegdar</title>
@endsection
@section('content')
<section class="bannercategory">
  <div class="container">
    <div class="bannertitle">
      <h1>   الحزم   </h1>
      <p>   الصفحة الرئيسية / الحزم   </p>
    </div>
  </div>
</section>
<!--Categorybanner-Title-end-->
<!--Section-Three-Start-->
<section class="package-section">
  <div class="container">
    <div class="packagetitle">
      <h2>  ايش يناسبك  </h2>
      <p>  اختر الباقة التي تناسبك   </p>
    </div>
    <div class="row">
      <div class="col-sm-12 col-xs-12">
        <div class="grid">
          <div class="row">
            @foreach($packages as $package)
            <div class="col-sm-4 col-xs-12">
              <figure class="effect-ming">
                <img style="width: 350px !important; height: 225px !important;" src="{{asset('uploads/packages/dashboard/'.$package->image_full)}}" alt="img01" class="img-fluid">
                <div class="gridtitle">   {{ $package->name_arabic }}   </div>
                <figcaption>
                  <h2>{{ $package->name_arabic }}</h2>
                  @php
                  $string = \Str::of($package->description_arabic)->words(22, ' .....');
                  @endphp
                  <p>{{$string}}</p> <a href="#" data-id="{{ $package->id }}" data-name="{{ $package->name_arabic }}" data-de="{{ $package->description_arabic }}" data-features="{{ $package->target_arabic }}" data-price="{{ $package->price}}" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter{{ $package->id }}">   المزيد   </a>
                </figcaption>
              </figure>
            </div>

            <div class="modal fade bd-example-modal-lg my-modal" id="exampleModalCenter{{ $package->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="popupimg">
                        <img src="{{asset('uploads/packages/dashboard/popup/'.$package->image_popup)}}" alt="image" class="img-fluid">
                      </div>
                    </div>
                    <div class="col-sm-8">
                      <div class="popupright">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="modaldetail">
                            <div class="modal-heading">{{ $package->name_arabic }}</div>
                            <p>{{$package->description_arabic}}</p>
                            <div class="modal-heading2">مميزات الباقة:</div>
                            <p>{{ $package->target_arabic }}</p>
                            <div class="item-name">سعر الباقة:</div>
                            <div class="price"> SAR <span>{{ $package->price}}</span>
                            </div>
                            <div class="modalbtn"> <a href="https://tegdarco.com/packages?package_id={{$package->id}}&currency=SAR" class="btn btn-light">   تواصل الدفع   </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>
    @endsection
    @push('scripts')
    @endpush