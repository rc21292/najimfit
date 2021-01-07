@extends('layouts.frontend.app')
@section('head')
<title>Welcome to Tegdar</title>
@endsection
@section('content')

  <div id="custCarousel" class="carousel slide carousel-fade" data-ride="carousel" align="center" data-interval="2000">
    <!-- slides -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="carousel-caption">
          <h3 class="h3-responsive">   مهما كان الهدف… تشوكلت؟ برقر؟ بيتزا؟ اي تقدر! وماتحتاج ارادة.. هات يدك ويلا بدينا   </h3>
          <p>سواء تبي / تبين خسارة الدهون أو نحافة شديدة أو كسل الغدة أو تعانين من التكيسات… مهما كان اللي تشوفه عائق دايماً في حل. ولاتنسى إن قلة الأكل ماتنحف، وتاكل تشوكلت وتنحف ولما تاكل اكثر بتنحف أكثر لأن الأكل لم يخلق ليترك والتغذية علم يدرس…</p>
          <div class="form-group btn-inline">
            <button type="button" class="btn btn-primary">انضم إلينا</button>
            <button type="button" class="btn btn-secondary">البرامج</button>
          </div>
        </div>
        <img src="{{asset('front_end/image/slider1.jpg')}}" alt="Hills">
      </div>
      <div class="carousel-item">
        <div class="carousel-caption">
          <h3 class="h3-responsive">   مهما كان الهدف… تشوكلت؟ برقر؟ بيتزا؟ اي تقدر! وماتحتاج ارادة.. هات يدك ويلا بدينا   </h3>
          <p>سواء تبي / تبين خسارة الدهون أو نحافة شديدة أو كسل الغدة أو تعانين من التكيسات… مهما كان اللي تشوفه عائق دايماً في حل. ولاتنسى إن قلة الأكل ماتنحف، وتاكل تشوكلت وتنحف ولما تاكل اكثر بتنحف أكثر لأن الأكل لم يخلق ليترك والتغذية علم يدرس…</p>
          <div class="form-group btn-inline">
            <button type="button" class="btn btn-primary">انضم إلينا</button>
            <button type="button" class="btn btn-secondary">البرامج</button>
          </div>
        </div>
        <img src="{{asset('front_end/image/banner2.jpg')}}" alt="Hills">
      </div>
      <div class="carousel-item">
        <div class="carousel-caption">
          <h3 class="h3-responsive">   مهما كان الهدف… تشوكلت؟ برقر؟ بيتزا؟ اي تقدر! وماتحتاج ارادة.. هات يدك ويلا بدينا   </h3>
          <p>سواء تبي / تبين خسارة الدهون أو نحافة شديدة أو كسل الغدة أو تعانين من التكيسات… مهما كان اللي تشوفه عائق دايماً في حل. ولاتنسى إن قلة الأكل ماتنحف، وتاكل تشوكلت وتنحف ولما تاكل اكثر بتنحف أكثر لأن الأكل لم يخلق ليترك والتغذية علم يدرس…</p>
          <div class="form-group btn-inline">
            <button type="button" class="btn btn-primary">انضم إلينا</button>
            <button type="button" class="btn btn-secondary">البرامج</button>
          </div>
        </div>
        <img src="{{asset('front_end/image/banner3.jpg')}}" alt="Hills">
      </div>
      <div class="carousel-item">
        <div class="carousel-caption">
          <h3 class="h3-responsive">   مهما كان الهدف… تشوكلت؟ برقر؟ بيتزا؟ اي تقدر! وماتحتاج ارادة.. هات يدك ويلا بدينا   </h3>
          <p>سواء تبي / تبين خسارة الدهون أو نحافة شديدة أو كسل الغدة أو تعانين من التكيسات… مهما كان اللي تشوفه عائق دايماً في حل. ولاتنسى إن قلة الأكل ماتنحف، وتاكل تشوكلت وتنحف ولما تاكل اكثر بتنحف أكثر لأن الأكل لم يخلق ليترك والتغذية علم يدرس…</p>
          <div class="form-group btn-inline">
            <button type="button" class="btn btn-primary">انضم إلينا</button>
            <button type="button" class="btn btn-secondary">البرامج</button>
          </div>
        </div>
        <img src="{{asset('front_end/image/banner4.jpg')}}" alt="Hills">
      </div>
    </div>
    <!-- Left right -->
    <a class="carousel-control-prev" href="#custCarousel" data-slide="prev">
      <img src="{{asset('front_end/image/Play-video-left.png')}}" alt="left" />
    </a>
    <a class="carousel-control-next" href="#custCarousel" data-slide="next">
      <img src="{{asset('front_end/image/Play-video-right.png')}}" alt="right" />
    </a>
    <!-- Thumbnails -->
    <ol class="carousel-indicators list-inline">
      <li class="list-inline-item active">
        <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#custCarousel">
          <img src="{{asset('front_end/image/indicators-img1.jpg')}}" class="img-fluid">
        </a>
      </li>
      <li class="list-inline-item">
        <a id="carousel-selector-1" data-slide-to="1" data-target="#custCarousel">
          <img src="{{asset('front_end/image/indicators-img2.jpg')}}" class="img-fluid">
        </a>
      </li>
      <li class="list-inline-item">
        <a id="carousel-selector-2" data-slide-to="2" data-target="#custCarousel">
          <img src="{{asset('front_end/image/indicators-img3.jpg')}}" class="img-fluid">
        </a>
      </li>
      <li class="list-inline-item">
        <a id="carousel-selector-2" data-slide-to="3" data-target="#custCarousel">
          <img src="{{asset('front_end/image/indicators-img4.jpg')}}" class="img-fluid">
        </a>
      </li>
    </ol>
  </div>
  <!--Slideshow-end-->
  <!--Section-one-->
  <section class="section1">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 padding">
          <div class="row">
            <div class="col-sm-4 padding">
              <div class="bg-cinnabar">
                <div class="space"></div>
                <div class="caption">
                  <div class="icons">
                    <svg width="70" height="70" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <image xlink:href="{{asset('front_end/image/infograph_3.svg')}}" height="70" width="70"></image>
                    </svg>
                  </div>
                  <p>هو ليس نمط أو نظام غذائي فقط.. هو تطبيق لجعل حياتك أسهل وأن تعيش كما أردت</p>
                </div>
              </div>
            </div>
            <div class="col-sm-4 padding">
              <div class="bg-bahamablue">
                <div class="space"></div>
                <div class="caption">
                  <div class="icons">
                    <svg width="70" height="70" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <image xlink:href="{{asset('front_end/image/infograph_2.svg')}}" height="70" width="70"></image>
                    </svg>
                  </div>
                  <p>أكلك وتمرينك مخصصان لحالتك ومفصلان على جسدك وطلبك</p>
                </div>
              </div>
            </div>
            <div class="col-sm-4 padding">
              <div class="bg-elfgreen">
                <div class="title">ايش نقدم</div>
                <div class="caption">
                  <div class="icons">
                    <svg width="70" height="70" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <image xlink:href="{{asset('front_end/image/infograph_1.svg')}}" height="70" width="70"></image>
                    </svg>
                  </div>
                  <p>قريبين منك كنبضك… تواصل فعال حتى تصل</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 padding">
          <div class="right-disc">
            <div class="righttitle">بعد أن نمسك بيدك</div>
            <p>في كل ثانية أنت تفوت شيء يعنيك ويجعلك أكثر تضامنا مع حياتك… فماذا لو امتلكت الثانية وجعلتها تنبض بكل ما أردت! بحب النفس وتعظيم الذات تحقق كل ماتريد وليس بأحلام فارغة أوتحفيز مؤقت! ألم تمل من التكرار واستنزاف طاقتك لشيء مؤقت في كل كرة !؟ لسنا نبيع الشيء لتعأود شرائه، فقلبنا يعطيك بلا توقف، فدعنا نشكل غذائك وحياتك وعملك ليكون كما أردت أنت فالتغيير أفضل صفة أعطاها الله للبشر فأنت “تقدر” وتستطيع فخذ نفساً عميقاً ودعنا نواصل الطريق معك.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--Section-one-end-->
  <!--Section-Two-Start-->
  <section class="section2">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-xs-12">
          <div class="leftdisc">
            <h4>  كلمة المؤسس  </h4>
            <p>نجم بن زياد.. هو اسمي وليس لقب. فمن هو الانسان في حقيقته؟ هو فيض من التجارب صنعت منه قيمته‘ فلا يعرف الانسان ماهو عليه اليوم حتى ينظر للنقطة التي انطلق منها وعلى قدر دهشته من الذي حققه هنا سيعرف أين هو.</p>
            <p>ولكن ماذا لو كان من واقفاً هناك لحظة انطلاقك قد أصابه الرعب من التغيير الذي وصلت له؟! أن تغير من نفسك ومن الناس هي قوة من استطاع أن يحاربها ليغير من نفسه ومن العالم سيكتب التاريخ اسمه. في اللحظة التي وصل وزني فيها إلى أكثر من 154 كيلو، كنت طفلا بهيئة مراهق.</p>
            <div class="text-center topbtn">
              <button type="button" class="btn btn-success">البرامج</button>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xs-12">
          <div class="imagesec">
            <img src="{{asset('front_end/image/infograph_4@2x.png')}}" alt="image" class="img-fluid">
          </div>
          <div class="appstore">
            <ul class="list-inline d-flex">
              <li>
                <a href="#">
                  <svg width="130" height="130" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <image xlink:href="{{asset('front_end/image/app_store_button_1.svg')}}" height="130" width="130"></image>
                  </svg>
                </a>
              </li>
              <li>
                <a href="#">
                  <svg width="130" height="130" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <image xlink:href="{{asset('front_end/image/google_play_button_1.svg')}}" height="130" width="130"></image>
                  </svg>
                </a>
              </li>
              <li>
                <a href="#"> <span>  متوافق مع الاندرود و الايفون  </span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--Section-Two-end-->
  <!--Section-Three-Start-->
  <section class="section3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 col-xs-6">
          <div class="gallerytopbtn text-left">
            <button type="button" class="btn btn-primary">عرض الكل</button>
          </div>
        </div>
        <div class="col-sm-6 col-xs-6">
          <div class="gallerytoptext text-right">ايش يناسبك</div>
        </div>
        <div class="col-sm-12 col-xs-12 padding">
          <div class="grid">
            <figure class="effect-ming">
              <img src="{{asset('front_end/image/gallery1.jpg')}}" alt="img01" class="img-fluid">
              <div class="gridtitle">باقة ارفع حرقك</div>
              <figcaption>
                <h2>  باقة ارفع حرقك  </h2>
                <p>كن ماذا لو كان من واقفاً هناك لحظة انطلاقك قد أصابه الرعب من التغيير الذي وصلت له؟! أن تغير من نفسك ومن الناس هي قوة من استطاع أن يحاربها ليغير من نفسه ومن العالم س</p> <a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter">   المزيد   </a>
              </figcaption>
            </figure>
            <figure class="effect-ming">
              <img src="{{asset('front_end/image/gallery3.jpg')}}" alt="img02" class="img-fluid">
              <div class="gridtitle">باقة تاكل تشوكلت تنحف</div>
              <figcaption>
                <h2>  باقة تاكل تشوكلت تنحف   </h2>
                <p>كن ماذا لو كان من واقفاً هناك لحظة انطلاقك قد أصابه الرعب من التغيير الذي وصلت له؟! أن تغير من نفسك ومن الناس هي قوة من استطاع أن يحاربها ليغير من نفسه ومن العالم س</p> <a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter">   المزيد   </a>
              </figcaption>
            </figure>
            <figure class="effect-ming">
              <img src="{{asset('front_end/image/gallery2.jpg')}}" alt="img02" class="img-fluid">
              <div class="gridtitle">باقة تاكل تشوكلت تنحف</div>
              <figcaption>
                <h2>  باقة تاكل تشوكلت تنحف   </h2>
                <p>كن ماذا لو كان من واقفاً هناك لحظة انطلاقك قد أصابه الرعب من التغيير الذي وصلت له؟! أن تغير من نفسك ومن الناس هي قوة من استطاع أن يحاربها ليغير من نفسه ومن العالم س</p> <a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter">   المزيد   </a>
              </figcaption>
            </figure>
          </div>
          <div class="grid">
            <figure class="effect-ming">
              <img src="{{asset('front_end/image/gallery3.jpg')}}" alt="img02" class="img-fluid">
              <div class="gridtitle">باقة حياتك نباتية</div>
              <figcaption>
                <h2>  باقة حياتك نباتية   </h2>
                <p>كن ماذا لو كان من واقفاً هناك لحظة انطلاقك قد أصابه الرعب من التغيير الذي وصلت له؟! أن تغير من نفسك ومن الناس هي قوة من استطاع أن يحاربها ليغير من نفسه ومن العالم س</p> <a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter">   المزيد   </a>
              </figcaption>
            </figure>
            <figure class="effect-ming">
              <img src="{{asset('front_end/image/gallery4.jpg')}}" alt="img02" class="img-fluid">
              <div class="gridtitle">باقة الحالات الصحية</div>
              <figcaption>
                <h2>  باقة الحالات الصحية   </h2>
                <p>كن ماذا لو كان من واقفاً هناك لحظة انطلاقك قد أصابه الرعب من التغيير الذي وصلت له؟! أن تغير من نفسك ومن الناس هي قوة من استطاع أن يحاربها ليغير من نفسه ومن العالم س</p> <a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter">   المزيد   </a>
              </figcaption>
            </figure>
            <figure class="effect-ming">
              <img src="{{asset('front_end/image/gallery5.jpg')}}" alt="img02" class="img-fluid">
              <div class="gridtitle">باقة تحكم في شهيتك</div>
              <figcaption>
                <h2>   باقة تحكم في شهيتك   </h2>
                <p>كن ماذا لو كان من واقفاً هناك لحظة انطلاقك قد أصابه الرعب من التغيير الذي وصلت له؟! أن تغير من نفسك ومن الناس هي قوة من استطاع أن يحاربها ليغير من نفسه ومن العالم س</p> <a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter">   المزيد   </a>
              </figcaption>
            </figure>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--Section-Three-end-->
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
  <!--Section-Five-Start-->
  <section class="section5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 padding">
          <div class="leftbox2">
            <h5>  لماذا نحن  </h5>
            <p>الحياة ليست خطاً واحداً، لايمكنك الاستمرار بخط مستقيم مدى حياتك فهذه طبيعة الحياة ولأنك بشر وقابل للتشكيل على أي جنب يناسبك ولكن أين البداية التي ستقودك بلا ألم! ستنزل من دوامة التعب إلى خط الراحة وسنساعدك لتكون أنت كما أردت ومثل ماكنت تريد أن تكون بحياتك الخاصة المبنية على شخصيتك وكيانك. هو ليس برنامج غذائي وحسب، بل هو شخصك الآخر الذي سيعيش معك كل حياتك من أول نفس لك في هذا العالم حتى اللحظة التي تنظر فيها لهذه الكلمة.</p>
            <p>من شخص الى كيان.. ومن أول نفس لك في هذا العالم حتى أعمق نقطة في حياتك في هذه اللحظة. هدفنا تغيير العالم.. لنأخذ بيدك حتى تعانق شعلة التغيير..</p>
            <p>نحن شركة تقدم خدمات صحية تثقيفية بشكل غيرمسبوق، ونقوم بهيكلة النمط الغذائي لعملائنا بطريقة مختلفة وغير تقليدية عبر إعادة برمجة غذائك بما يتناسب مع حياتك الحالية بدون أي ضغط أو إرادة مزيفة أو مؤقتة.. فنحن معك في كل مكان.. في منصات التواصل الإجتماعي أوالتواصل الفعلي والمرئي.. نتواجد معك في جميع أنحاء العالم.</p>
          </div>
        </div>
        <div class="col-sm-6 padding">
          <div id="blogCarousel" class="carousel slide container-blog postion" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#blogCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#blogCarousel" data-slide-to="1"></li>
            </ol>
            <!-- Carousel items -->
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="row">
                  <div class="col-md-4">
                    <div class="item-box-blog">
                      <div class="item-box-blog-body">
                        <img alt="" src="{{asset('front_end/image/carousel3.jpg')}}" class="img-fluid">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="item-box-blog">
                      <div class="item-box-blog-body">
                        <img alt="" src="{{asset('front_end/image/carousel1.jpg')}}" class="img-fluid">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="item-box-blog">
                      <div class="item-box-blog-body">
                        <img alt="" src="{{asset('front_end/image/carousel2.jpg')}}" class="img-fluid">
                      </div>
                    </div>
                  </div>
                </div>
                <!--.row-->
              </div>
              <!--.item-->
              <div class="carousel-item ">
                <div class="row">
                  <div class="col-md-4">
                    <div class="item-box-blog">
                      <div class="item-box-blog-body">
                        <img alt="" src="{{asset('front_end/image/carousel3.jpg')}}" class="img-fluid">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="item-box-blog">
                      <div class="item-box-blog-body">
                        <img alt="" src="{{asset('front_end/image/carousel1.jpg')}}" class="img-fluid">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="item-box-blog">
                      <div class="item-box-blog-body">
                        <img alt="" src="{{asset('front_end/image/carousel2.jpg')}}" class="img-fluid">
                      </div>
                    </div>
                  </div>
                </div>
                <!--.row-->
              </div>
              <!--.item-->
            </div>
            <!--.carousel-inner-->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--Section-Five-End-->
  <!--Section-Six-Start-->
  <section class="section6">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="contactform">
            <h6>  اتصل  </h6>
            <form class="row">
              <div class="form-group col-md-6">
                <input type="text" class="form-control" placeholder="البريد الإلكتروني">
              </div>
              <div class="form-group col-md-6">
                <input type="email" class="form-control" placeholder="اسم">
              </div>
              <div class="form-group col-md-12">
                <textarea class="form-control" placeholder=" رسالة " rows="5"></textarea>
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

@endsection
@push('scripts')

@endpush