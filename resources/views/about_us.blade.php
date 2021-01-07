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
  <!--Categorybanner-Title-end-->
  <!--Section-One-Start-->
  <section class="about-section">
    <div class="container">
      <h2>   لماذا نحن   </h2>
      <div class="row">
        <div class="col-sm-12 col-xs-12">
          <div class="about-discrip">
            <p>   اً واحداً، لايمكنك الاستمرار بخط مستقيم مدى حياتك فهذه طبيعة الحياة ولأنك بشر وقابل للتشكيل على أي جنب يناسبك ولكن أين البداية التي ستقودك بلا ألم! ستنزل من دوامة التعب إلى خط الراحة وسنساعدك لتكون أنت كما أردت ومثل ماكنت تريد أن تكون بحياتك الخاصة المبنية على شخصيتك وكيانك. هو ليس برنامج غذائي وحسب،  بل هو شخصك الآخر الذي سيعيش معك كل حياتك من أول نفس لك في هذا العالم حتى اللحظة التي تنظر فيها لهذه الكلمة.   </p>

            <p>  من شخص الى كيان.. ومن أول نفس لك في هذا العالم حتى أعمق نقطة في حياتك في هذه اللحظة. هدفنا تغيير العالم.. لنأخذ بيدك حتى تعانق شعلة التغيير..  </p>

            <p>   نحن شركة تقدم خدمات صحية تثقيفية بشكل غيرمسبوق، ونقوم بهيكلة النمط الغذائي لعملائنا بطريقة مختلفة وغير تقليدية عبر إعادة برمجة غذائك بما يتناسب مع حياتك الحالية بدون أي ضغط أو إرادة مزيفة أو مؤقتة.. فنحن معك في كل مكان.. في منصات التواصل الإجتماعي أوالتواصل الفعلي والمرئي.. نتواجد معك في جميع أنحاء العالم.   </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--Section-One-end-->
  <!--Section-Two-Start-->
  <section class="about-section2">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 col-xs-12 padding">
          <div class="leftimage">
            <img src="{{asset('front_end/image/aboutleftimg.jpg')}}" alt="about-left" class="img-fluid">
          </div>
        </div>
        <div class="col-sm-6 col-xs-12 padding">
          <div class="righttext">
            <p>  سواء تبي / تبين خسارة الدهون أو نحافة شديدة أو كسل الغدة أو تعانين من التكيسات… مهما كان اللي تشوفه عائق دايماً في حل. ولاتنسى إن قلة الأكل ماتنحف، وتاكل تشوكلت وتنحف ولما تاكل اكثر بتنحف أكثر لأن الأكل لم يخلق ليترك والتغذية علم يدرس…  </p>
            <div class="righttext2">
              <h3>   بعد أن نمسك بيدك   </h3>
              <p>   في كل ثانية أنت تفوت شيء يعنيك ويجعلك أكثر تضامنا مع حياتك… فماذا لو امتلكت الثانية وجعلتها تنبض بكل ما أردت! بحب النفس وتعظيم الذات تحقق كل ماتريد وليس بأحلام فارغة أوتحفيز مؤقت! ألم تمل من التكرار واستنزاف طاقتك لشيء مؤقت في كل كرة  !؟ لسنا نبيع الشيء لتعأود شرائه، فقلبنا يعطيك بلا توقف، فدعنا نشكل غذائك وحياتك وعملك ليكون كما أردت أنت فالتغيير أفضل صفة أعطاها الله للبشر فأنت “تقدر” وتستطيع فخذ نفساً عميقاً ودعنا نواصل الطريق معك.   </p>
            </div>
            <div class="righttext2">
              <h3>   ايش نقدم   </h3>
              <p>   1-قريبين منك كنبضك… تواصل فعال حتى تصل   </p>
              <p>  2-أكلك وتمرينك مخصصان لحالتك ومفصلان على جسدك وطلبك  </p>
              <p>   3-هو ليس نمط أو نظام غذائي فقط.. هو تطبيق لجعل حياتك أسهل وأن تعيش كما أردت   </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--Section-Two-End-->
  <!--Section-Three-Start-->
  <section class="ftco-counter counter ftco-section ftco-no-pt ftco-no-pb img" id="section-counter">
    <div class="container">
      <div class="row text-center">
        <div class="col">
          <div class="counter">
            <svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
              <image xlink:href="{{asset('front_end/image/time_icon.svg')}}" height="40" width="40"></image>
            </svg>
            <h2 class="timer count-title count-number" data-to="2314" data-speed="1500"></h2>
            <p class="count-text ">   ساعات العمل   </p>
          </div>
        </div>
        <div class="col">
          <div class="counter">
            <svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
              <image xlink:href="{{asset('front_end/image/heart_icon.svg')}}" height="40" width="40"></image>
            </svg>
            <h2 class="timer count-title count-number" data-to="314" data-speed="1500"></h2>
            <p class="count-text ">   عملاء سعداء   </p>
          </div>
        </div>
        <div class="col">
          <div class="counter">
            <svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
              <image xlink:href="{{asset('front_end/image/star_icon.svg')}}" height="40" width="40"></image>
            </svg>
            <h2 class="timer count-title count-number" data-to="214" data-speed="1500"></h2>
            <p class="count-text ">   جائزة الفوز  </p>
          </div>
        </div>
        <div class="col">
          <div class="counter">
            <svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
              <image xlink:href="{{asset('front_end/image/smilyface_icon.svg')}}" height="40" width="40"></image>
            </svg>
            <h2 class="timer count-title count-number" data-to="231" data-speed="1500"></h2>
            <p class="count-text ">   عملاء راضون   </p>
          </div>
        </div>
      </div>
    </div>
  </section>
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