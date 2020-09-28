<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Laravel</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

  <!-- Styles -->
  <style>
    html, body {
      background-color: #fff;
      color: #636b6f;
      font-family: 'Nunito', sans-serif;
      font-weight: 200;
      height: 100vh;
      margin: 0;
    }

    .full-height {
      height: 100vh;
    }

    .flex-center {
      align-items: center;
      display: flex;
      justify-content: center;
      background-image: url('backend/assets/img/home2.jpg');
      background-size: 100%
    }

    .position-ref {
      position: relative;
    }

    .top-right {
      position: absolute;
      right: 366px;
      top: 417px;
    }

    .content {
      text-align: center;
    }

    .title {
      font-size: 84px;
      position: absolute;
      right: 229px;
      top: 296px;
    }

    .links > a {
      color: #636b6f;
      padding: 9px 25px;
      font-size: 13px;
      font-weight: 600;
      letter-spacing: .1rem;
      text-decoration: none;
      text-transform: uppercase;
    }

    .m-b-md {
      margin-bottom: 30px;
    }
    .button {
      background-color: #4CAF50; /* Green */
      border: none;
      color: white;
      padding: 16px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      transition-duration: 0.4s;
      cursor: pointer;
    }
    .button3 {
      background-color: white; 
      color: black; 
      border: 2px solid #f44336;
    }

    .button3:hover {
      background-color: #f44336;
      color: white;
    }
  </style>
</head>
<body>
  <div class="flex-center position-ref full-height">
    @if (Route::has('login'))
    <div class="top-right links">
      @auth
      <a class="button button3" href="{{ url('/home') }}">Dashboard</a>
      @else
      <a class="button button3" href="{{ route('login') }}">Login</a>
      @endauth
    </div>
    @endif

    <div class="content">
      <div class="title m-b-md">
        NAJIM FIT
      </div>
    </div>
  </div>
</body>
</html>
