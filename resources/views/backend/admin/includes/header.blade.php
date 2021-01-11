    <!-- Navigation Bar -->
    <nav class="navbar ms-navbar">

      <div class="ms-aside-toggler ms-toggler pl-0" data-target="#ms-side-nav" data-toggle="slideLeft">
        <span class="ms-toggler-bar bg-primary"></span>
        <span class="ms-toggler-bar bg-primary"></span>
        <span class="ms-toggler-bar bg-primary"></span>
      </div>

      <div class="logo-sn logo-sm ms-d-block-sm">
        <a class="pl-0 ml-0 text-center navbar-brand mr-0" href="{{route('home')}}"><img src="{{asset('backend/assets/img/admin.png')}}" alt="logo"> </a>
      </div>

      <ul class="ms-nav-list ms-inline mb-0" id="ms-nav-options">
        @php

        $user = Auth::User();
        $roles = $user->getRoleNames();
        $role_name =  $roles->implode('', ' ');

        if($role_name == 'Nutritionist'){
        @endphp
        <li class="ms-nav-item ms-nav-user dropdown">
          <a href="/dashboard/chat" title="Chats" class="text-disabled ms-has-notification get-notifications">0 <i class="flaticon-chat"></i></a>
        </li>
        <li class="ms-nav-item ms-nav-user dropdown">
          <a href="/dashboard/admin-requests" title="Admin Requests" class="text-disabled ms-has-notification">{{{ App\Helper::getAdminRequestsCount()}}} <i class="fa fa-envelope" aria-hidden="true"></i></a>
        </li>
        <li class="ms-nav-item ms-nav-user dropdown">
          <a href="{{url('dashboard/meeting-notifications')}}" title="Notifications" class="text-disabled ms-has-notification">0 <i class="flaticon-bell"></i></a>
        </li>
        
        @php
      }
      @endphp        
        <li class="ms-nav-item ms-nav-user dropdown">
          <a href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img class="ms-user-img ms-img-round float-right" src="{{asset('backend/assets/img/avatar.png')}}" alt="people"> </a>
          <ul class="dropdown-menu dropdown-menu-right user-dropdown" aria-labelledby="userDropdown">
            <li class="dropdown-menu-header">
              <h6 class="dropdown-header ms-inline m-0"><span class="text-disabled">Welcome Admin</span></h6>
            </li>
            <li class="dropdown-divider"></li>
            <li class="ms-dropdown-list">
              <a class="media fs-14 p-2" href="{{ route('my-account.index') }}"> <span><i class="flaticon-user mr-2"></i> Profile</span> </a>
            </li>
            <li class="dropdown-divider"></li>
            <li class="dropdown-menu-footer">
              <a class="media fs-14 p-2" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              <span><i class="flaticon-shut-down mr-2"></i> {{ __('Logout') }}</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>

          </li>
        </ul>
      </li>
    </ul>
    <div class="ms-toggler ms-d-block-sm pr-0 ms-nav-toggler" data-toggle="slideDown" data-target="#ms-nav-options">
      <span class="ms-toggler-bar bg-primary"></span>
      <span class="ms-toggler-bar bg-primary"></span>
      <span class="ms-toggler-bar bg-primary"></span>
    </div>
  </nav>

@push('scripts')
<script src="https://www.gstatic.com/firebasejs/4.9.1/firebase.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js" integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA==" crossorigin="anonymous"></script>
<script>
  var firebaseConfig = {
        apiKey: "AIzaSyDfaDyhvmTp-Za0PUXGtK8pqJffNV0UM98",
        authDomain: "test-tegdarco.firebaseapp.com",
        databaseURL: "https://test-tegdarco.firebaseio.com",
        projectId: "test-tegdarco",
        storageBucket: "test-tegdarco.appspot.com",
        messagingSenderId: "451237505127",
        appId: "1:451237505127:web:121a1743e95ff8d1be0cc2",
        measurementId: "G-0P6W55LWN2"
    };
        firebase.initializeApp(firebaseConfig);

        var datas = firebase.database().ref('/chats').orderByChild("is_read").equalTo(0).on('value', function(snapshot) {
          var chat_element = "";
          if(snapshot.val() != null) {
            var count = 0;
            snapshot.forEach(function(childSnapshot) {
              var childData = childSnapshot.val();
              if (childData.message_from = 'user') {
                if (childData.receiver_id == '{{Auth::user()->id}}') {
                  count++;
                }
              }              
            });
            $(".get-notifications").html(count+' <i class="flaticon-chat"></i>');
        // console.log(count);
          }
        });
        </script>
    @endpush