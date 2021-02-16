<header> 
  <nav class="navbar navbar-expand-lg navbar-light bg-dark">
      <div class="container">
        <a class="navbar-brand" href="/">
          <img src="{{asset('front_end/image/tegdar_logo.png')}}" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item {{ Request::is('terms-conditions') ? 'active' : '' }}"> <a class="nav-link" href="/terms-conditions">شروط و الاحكام   </a>
            </li>
            <li class="nav-item {{ Request::is('contactus') ? 'active' : '' }}"> <a class="nav-link" href="/contactus">   اتصل بنا   </a>
            </li>
            <li class="nav-item {{ Request::is('aboutus') ? 'active' : '' }}"> <a class="nav-link" href="/aboutus">   معلومات عنا   </a>
            </li>
            <li class="nav-item {{ Request::is('gallery') ? 'active' : '' }}"> <a class="nav-link" href="/gallery">   صالة عرض   </a>
            </li>
            <li class="nav-item {{ Request::is('packages') ? 'active' : '' }}"> <a class="nav-link" href="/packages">  خدماتنا  </a>
            </li>
            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}"> <a class="nav-link" href="/">  الصفحة الرئيسية   </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>