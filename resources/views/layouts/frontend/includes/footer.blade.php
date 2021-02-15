 <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-2 col-xs-12">
          <div class="appicon">
            <ul class="list-unstyled">
              <li>
                <a href="#">
                  <svg width="150" height="50" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <image xlink:href="{{asset('front_end/image/app_store_button_2.svg')}}" height="50" width="150"></image>
                  </svg>
                </a>
              </li>
              <li>
                <a href="https://play.google.com/store/apps/details?id=com.tegdar">
                  <svg width="150" height="50" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <image xlink:href="{{asset('front_end/image/google_play_button_2.svg')}}" height="50" width="150"></image>
                  </svg>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-2 col-xs-12">
          <div class="footer_widget">
            <div class="footertitle">ابقى على تواصل</div>
            <p>info@najimfitness.com
              <br>7536, Janabiyah
              <br>Bahrain</p>
          </div>
        </div>
        <div class="col-sm-4 col-xs-12">
          <div class="footer_widget">
            <div class="footertitle">تابعنا</div>
            <div class="social-icon">
              <ul class="list-inline d-flex">
                <li>
                  <a href="#">
                    <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <image xlink:href="{{asset('front_end/image/linkedin_icon_2.svg')}}" height="25" width="25"></image>
                    </svg>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <image xlink:href="{{asset('front_end/image/twitter_icon_2.svg')}}" height="25" width="25"></image>
                    </svg>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <image xlink:href="{{asset('front_end/image/youtube_icon_2.svg')}}" height="25" width="25"></image>
                    </svg>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <image xlink:href="{{asset('front_end/image/snapchat_icon_2.svg')}}" height="25" width="25"></image>
                    </svg>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <image xlink:href="{{asset('front_end/image/whatsapp_icon_2.svg')}}" height="25" width="25"></image>
                    </svg>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <image xlink:href="{{asset('front_end/image/instagram_icon_2.svg')}}" height="25" width="25"></image>
                    </svg>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-4 col-xs-12">
          <div class="footer_widget">
            <div class="footertitle">النشرة الإخبارية</div>
            <div class="disc">اشترك في النشرة الإخبارية لدينا للحصول على أحدث النصائح الصحية</div>
            <div class="subscribe_form" id="myDiv">
              @if (\Session::has('success_news'))
              <div class="alert alert-success">
                <p>{{ \Session::get('success_news') }}</p>
              </div><br/>
              @endif
              @if (\Session::has('failure_news'))
              <div class="alert alert-danger">
                <p>{{ \Session::get('success_news') }}</p>
              </div><br/>
              @endif
              <form class="subscribe_form" method="post" action="{{url('newsletter/store')}}">
                @csrf
                <div class="form-group">
                  <input type="email"  required name="email" class="form-control @error('email') is-invalid @enderror" placeholder="  إيميلك الإلكتروني  ">
                  @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
                <button type="submit" class="btn btn-primary">إرسال</button>
                <div class="clearfix"></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!--Footer-End-->
  <!-- Modal -->
  <div class="modal fade bd-example-modal-lg my-modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="row">
          <div class="col-sm-4">
            <div class="popupimg">
              <img src="{{asset('front_end/image/popup-image.png')}}" alt="image" class="img-fluid">
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
                  <div class="modal-heading">باقة الحامل والمرضع</div>
                  <p>زيادة الوزن في الحمل وعدم نزول وزنك مابعد الحمل كل هذي لازم تكون بضوابط وحدود معينة نحافظ عليها. هالباقة لكل أم في العالم في فترة الحمل والرضاعة والنفاس. دايما بنكون معك عشان ماتكسبين دهون زايدة، وبعد الحمل يرجع وزنك طبيعي</p>
                  <div class="modal-heading2">مميزات الباقة:</div>
                  <p>إمكانية طلب تعديل على النمط الخاص بك حسب حاجتك</p>
                  <p>متابعة خاصة اسبوعية ورد اسبوعي على استفساراتك</p>
                  <p>إضافة اتصال أو تواصل صوتي لشرح الحالة قبل تسليم الجدول حسب الرغبة</p>
                  <p>الإشتراك شهري يجدد شهرياً بشكل دوري حسب حاجتك</p>
                  <div class="item-name">سعر الباقة:</div>
                  <div class="price">دينار بحريني <span>60</span>
                  </div>
                  <div class="modalbtn"> <a href="#" class="btn btn-light">   تواصل الدفع   </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal-End -->
  <!--Script-Start-->
  <script src="{{asset('front_end/js/jquery-3.3.1.slim.min.js')}}"></script>
  <script src="{{asset('front_end/js/popper.min.js')}}"></script>
  <script src="{{asset('front_end/js/bootstrap.min.js')}}"></script>
  <!--Script-End-->
  <script type="text/javascript">
    $(document).ready(function() {      
        $(".fa-search").click(function() {
           $(".search-box").toggle();
           $("input[type='text']").focus();
         });
 
    });


    @if (\Session::has('success_news'))
      $(window).scrollTop($('#myDiv').offset().top);
    @endif

    @if (\Session::has('success'))
      $(window).scrollTop($('#myDivContact').offset().top);
    @endif

    
  </script> 
  @stack('scripts')