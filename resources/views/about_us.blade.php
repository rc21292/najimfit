@extends('layouts.frontend.app')
@section('head')
<title>Welcome to Tegdar</title>
@endsection
@section('content')
    <!--Categorybanner-Title-->
  <section class="bannercategory">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-xs-12">
          <div class="bannerlogo">
            <img src="{{asset('front_end/image/bannerlogo.png')}}" alt="bannerlogo" class="img-fluid">
          </div>
        </div>
        <div class="col-sm-6 col-xs-12">
          <div class="bannertitle">
            <h1>   معلومات عنا   </h1>
            <p>   الصفحة الرئيسية / معلومات عنا   </p>
          </div>
        </div>
      </div>
    </div>
  </section>
{!!$about->content!!}
  <!--Section-Three-End-->
  <!--Section-Four-Start-->
  <section class="section4">
    <div class="container-fluid">
      <div class="clienttitle">
        <h4>  (فريق تقدر)     عائلتك الثانية</h4>
      </div>
      <div class="row">
        <div class="col-sm-12 col-xs-12">
          <div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="row">
                  <div class="col-sm-6 col-xs-12">
                    <div class="fancybox">
                      <div class="fancytitle">نجم بن زياد</div>
                      <div class="disc2">مؤسس الشركة ومدرب نمط الحياة الصحية</div>
                      <p>حب نفسك وشخصك بكل ما لديك وبكل ما تملك، حب عيوبك وسلبياتك وإيجابياتك.. فالتغيير الإيجابي لا ينتج عن كره ومشاعر سلبية، حب الذات هو أول خطوة في طريق التغيير.. غير نفسك للأفضل لأنك تريد الأفضل لنفسك لأنك تحب نفسك.. وأعدك أنك ستنجح وستتغير</p>
                      <div class="socialmedia">
                        <ul class="list-inline d-flex">
                          <li> <a href="#"><span><img src="{{asset('front_end/image/facebook_icon_1.png')}}" alt="icon"></span></a>
                          </li>
                          <li> <a href="#"><span><img src="{{asset('front_end/image/twitter_icon_1.png')}}" alt="icon"></span></a>
                          </li>
                          <li> <a href="#"><span><img src="{{asset('front_end/image/instagram_icon_1.png')}}" alt="icon"></span></a>
                          </li>
                          <li> <a href="#"><span><img src="{{asset('front_end/image/youtube_icon_1.png')}}" alt="icon"></span></a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-xs-12">
                    <div class="item-box-blog">
                      <div class="item-box-blog-body">
                        <img alt="" src="{{asset('front_end/image/fancycarousel1.png')}}" class="img-fluid">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="row">
                  <div class="col-sm-6 col-xs-12">
                    <div class="fancybox">
                      <div class="fancytitle">نجم بن زياد</div>
                      <div class="disc2">مؤسس الشركة ومدرب نمط الحياة الصحية</div>
                      <p>حب نفسك وشخصك بكل ما لديك وبكل ما تملك، حب عيوبك وسلبياتك وإيجابياتك.. فالتغيير الإيجابي لا ينتج عن كره ومشاعر سلبية، حب الذات هو أول خطوة في طريق التغيير.. غير نفسك للأفضل لأنك تريد الأفضل لنفسك لأنك تحب نفسك.. وأعدك أنك ستنجح وستتغير</p>
                      <div class="socialmedia">
                        <ul class="list-inline d-flex">
                          <li> <a href="#"><span><img src="{{asset('front_end/image/facebook_icon_1.png')}}" alt="icon"></span></a>
                          </li>
                          <li> <a href="#"><span><img src="{{asset('front_end/image/twitter_icon_1.png')}}" alt="icon"></span></a>
                          </li>
                          <li> <a href="#"><span><img src="{{asset('front_end/image/instagram_icon_1.png')}}" alt="icon"></span></a>
                          </li>
                          <li> <a href="#"><span><img src="{{asset('front_end/image/youtube_icon_1.png')}}" alt="icon"></span></a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-xs-12">
                    <div class="item-box-blog">
                      <div class="item-box-blog-body">
                        <img alt="" src="{{asset('front_end/image/fancycarousel2.png')}}" class="img-fluid">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="row">
                  <div class="col-sm-6 col-xs-12">
                    <div class="fancybox">
                      <div class="fancytitle">نجم بن زياد</div>
                      <div class="disc2">مؤسس الشركة ومدرب نمط الحياة الصحية</div>
                      <p>حب نفسك وشخصك بكل ما لديك وبكل ما تملك، حب عيوبك وسلبياتك وإيجابياتك.. فالتغيير الإيجابي لا ينتج عن كره ومشاعر سلبية، حب الذات هو أول خطوة في طريق التغيير.. غير نفسك للأفضل لأنك تريد الأفضل لنفسك لأنك تحب نفسك.. وأعدك أنك ستنجح وستتغير</p>
                      <div class="socialmedia">
                        <ul class="list-inline d-flex">
                          <li> <a href="#"><span><img src="{{asset('front_end/image/facebook_icon_1.png')}}" alt="icon"></span></a>
                          </li>
                          <li> <a href="#"><span><img src="{{asset('front_end/image/twitter_icon_1.png')}}" alt="icon"></span></a>
                          </li>
                          <li> <a href="#"><span><img src="{{asset('front_end/image/instagram_icon_1.png')}}" alt="icon"></span></a>
                          </li>
                          <li> <a href="#"><span><img src="{{asset('front_end/image/youtube_icon_1.png')}}" alt="icon"></span></a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-xs-12">
                    <div class="item-box-blog">
                      <div class="item-box-blog-body">
                        <img alt="" src="{{asset('front_end/image/fancycarousel3.png')}}" class="img-fluid">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <img src="{{asset('front_end/image/Play-video-left.png')}}" alt="left">
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <img src="{{asset('front_end/image/Play-video-right.png')}}" alt="right">
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--Section-Four-End-->
  <!--Footer-Start-->
@endsection
@push('scripts')
<script type="text/javascript">
    (function ($) {
      $.fn.countTo = function (options) {
        options = options || {};
        
        return $(this).each(function () {
          // set options for current element
          var settings = $.extend({}, $.fn.countTo.defaults, {
            from:            $(this).data('from'),
            to:              $(this).data('to'),
            speed:           $(this).data('speed'),
            refreshInterval: $(this).data('refresh-interval'),
            decimals:        $(this).data('decimals')
          }, options);
          
          var loops = Math.ceil(settings.speed / settings.refreshInterval),
            increment = (settings.to - settings.from) / loops;
          
          // references & variables that will change with each update
          var self = this,
            $self = $(this),
            loopCount = 0,
            value = settings.from,
            data = $self.data('countTo') || {};
          
          $self.data('countTo', data);
          
          // if an existing interval can be found, clear it first
          if (data.interval) {
            clearInterval(data.interval);
          }
          data.interval = setInterval(updateTimer, settings.refreshInterval);
          
          // initialize the element with the starting value
          render(value);
          
          function updateTimer() {
            value += increment;
            loopCount++;
            
            render(value);
            
            if (typeof(settings.onUpdate) == 'function') {
              settings.onUpdate.call(self, value);
            }
            
            if (loopCount >= loops) {
              // remove the interval
              $self.removeData('countTo');
              clearInterval(data.interval);
              value = settings.to;
              
              if (typeof(settings.onComplete) == 'function') {
                settings.onComplete.call(self, value);
              }
            }
          }
          
          function render(value) {
            var formattedValue = settings.formatter.call(self, value, settings);
            $self.html(formattedValue);
          }
        });
      };
      
      $.fn.countTo.defaults = {
        from: 0,               
        to: 0,                 
        speed: 1000,           
        refreshInterval: 100,  
        decimals: 0,           
        formatter: formatter,  
        onUpdate: null,        
        onComplete: null 
      };
      
      function formatter(value, settings) {
        return value.toFixed(settings.decimals);
      }
    }(jQuery));

    jQuery(function ($) {
      // custom formatting example
      $('.count-number').data('countToOptions', {
      formatter: function (value, options) {
        return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
      }
      });
      
      // start all the timers
      $('.timer').each(count);  
      
      function count(options) {
      var $this = $(this);
      options = $.extend({}, options || {}, $this.data('countToOptions') || {});
      $this.countTo(options);
      }
    });
  </script>
@endpush