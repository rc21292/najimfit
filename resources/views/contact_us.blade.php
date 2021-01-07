@extends('layouts.frontend.app')
@section('head')
<title>Welcome to Tegdar</title>
@endsection
@section('content')
  <!--Categorybanner-Title-->
  <section class="bannercategory">
    <div class="container">
      <div class="bannertitle">
        <h1>   اتصل   </h1>
        <p>   الصفحة الرئيسية / اتصل  </p>
      </div>
    </div>
  </section>
  <!--Categorybanner-Title-end-->
  <!--Section-One-Start-->
  <section class="contact-section">
    <div class="contact-info">
      <div class="container">
        <div class="row">
          <div class="col-sm-4 col-xs-12">
            <div class="contactinfo">
              <svg width="70" height="70" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
              <image xlink:href="{{asset('front_end/image/phone_icon.svg')}}" height="70" width="70"></image>
             </svg>
              <h2>   مكالمة   </h2>
              <p><a href="tel:+973 17009007">+973 17009007</a></p>
            </div>
          </div>
          <div class="col-sm-4 col-xs-12">
            <div class="contactinfo">
              <svg width="70" height="70" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
              <image xlink:href="{{asset('front_end/image/location_icon.svg')}}" height="70" width="70"></image>
             </svg>
              <h2>   عنوان   </h2>
              <p>Office 42, Building 870, Road 3618, Block 436 - Seef District</p>
            </div>
          </div>
          <div class="col-sm-4 col-xs-12">
            <div class="contactinfo">
              <svg width="70" height="70" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
              <image xlink:href="{{asset('front_end/image/email_icon.svg')}}" height="70" width="70"></image>
             </svg>
              <h2>   بريد   </h2>
              <p><a href="mailto:info@tegdarco.com">info@tegdarco.com</a></p>
            </div>
          </div>
        </div>
        </div>
    </div>
  </section>
  <!--Section-One-end-->
  <!--Section-Two-Start-->
  <section class="section6">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="contactform">
            <h6>   اتصل   </h6>
            <form class="row">
              <div class="form-group col-md-6">
                <input type="text" class="form-control" placeholder="   البريد الإلكتروني   ">
              </div>
              <div class="form-group col-md-6">
                <input type="email" class="form-control" placeholder="   اسم   ">
              </div>
              <div class="form-group col-md-12">
                <textarea class="form-control" placeholder="    رسالة    " rows="5"></textarea>
              </div>
              <div class="col-12 mt-4">
                <button type="submit" class="btn btn-primary">   إرسال   </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--Section-Two-End-->
@endsection
@push('scripts')

@endpush