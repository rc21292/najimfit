  <!-- Sidebar Navigation Left -->
  <aside id="ms-side-nav" class="side-nav fixed ms-aside-scrollable ms-aside-left">
    @role('Admin')
    <!-- Logo -->
    <div class="logo-sn ms-d-block-lg">
      <a class="pl-0 ml-0 text-center" href="{{route('home')}}"> <img src="{{asset('backend/assets/img/admin.png')}}" alt="logo"> </a>
    </div>

    <!-- Navigation -->
    <ul class="accordion ms-main-aside fs-14" id="side-nav-accordion">

      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#form-elements" aria-expanded="false" aria-controls="form-elements">
          <span><i class="fas fa-plus"></i>Add Features</span>
        </a>
        <ul id="form-elements" class="collapse" aria-labelledby="form-elements" data-parent="#side-nav-accordion">
          <li> <a href="{{ route('tables.index') }}">New Tables</a> </li>
          <li> <a href="{{ route('exercise.index') }}">New Workouts</a> </li>
          <li> <a href="{{ route('package.index') }}">New Packages</a> </li>
          <li> <a href="{{ route('question.index') }}">New Questionnaire</a> </li>
        </ul>
      </li>

      <!-- /Advanced UI Elements -->

      <li class="menu-item">
        <a href="{{ route('client-chats.index') }}">
          <span><i class="fab fa-stack-exchange"></i>Chats</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#form-elements1" aria-expanded="false" aria-controls="form-elements1">
          <span><i class="fas fa-table"></i>Tables</span>
        </a>
        <ul id="form-elements1" class="collapse" aria-labelledby="form-elements1" data-parent="#side-nav-accordion">
          <li> <a href="{{route('assign-table.index')}}">Assign Tables</a></li>
          <li> <a href="{{route('renew-table.index')}}">Renew Tables</a> </li>
        </ul>
      </li>
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#form-elements2" aria-expanded="false" aria-controls="form-elements2">
          <span><i class="fas fa-burn"></i>Workouts</span>
        </a>
        <ul id="form-elements2" class="collapse" aria-labelledby="form-elements2" data-parent="#side-nav-accordion">
          <li><a href="{{route('assign-workout.index')}}">Assign Workout</a></li>
          <li><a href="{{route('renew-workout.index')}}">Renew Workout</a></li>
        </ul>
      </li>
      <li class="menu-item">
        <a href="{{route('intake-substances.index')}}">
          <span><i class="far fa-user-circle"></i>Intake Substances</span>
        </a>
      </li>  
      <li class="menu-item">
        <a href="{{route('clients.index')}}">
          <span><i class="far fa-user-circle"></i>Clients</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('requests.index')}}">
          <span><i class="fa fa-anchor"></i>Requests</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('complaints.index')}}">
          <span><i class="fas fa-exclamation-triangle"></i>Complaints</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="#">
          <span><i class="fa fa-cogs"></i>Controls</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{url('dashboard/staff-chats')}}">
          <span><i class="fab fa-teamspeak"></i>Staff Chats</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('coupons.index')}}">
          <span><i class="fa fa-cogs"></i>Coupons</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="#">
          <span><i class="fas fa-users"></i>Teams</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('datas.index')}}">
          <span><i class="fa fa-database"></i>Data</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="#">
          <span><i class="fa fa-handshake"></i>Share and Meetings</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{url('dashboard/fullcalendar')}}">
          <span><i class="fa fa-calendar"></i>Calender</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('notes.index')}}">
          <span><i class="far fa-clipboard"></i>Notes</span>
        </a>
      </li>

      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#form-elements" aria-expanded="false" aria-controls="form-elements">
          <span><i class="fas fa-key"></i>User Management</span>
        </a>
        <ul id="form-elements" class="collapse" aria-labelledby="form-elements" data-parent="#side-nav-accordion">
          <li> <a href="{{ route('users.index') }}">Users</a> </li>
          <li> <a href="{{ route('roles.index') }}">Roles</a> </li>
        </ul>
      </li>

      <!-- Form Elements -->
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#form-elements" aria-expanded="false" aria-controls="form-elements">
          <span><i class="material-icons fs-16">settings</i>Settings</span>
        </a>
        <ul id="form-elements" class="collapse" aria-labelledby="form-elements" data-parent="#side-nav-accordion">
          <li> <a href="{{route('diet-informations.index')}}">Diet Informations</a> </li>
          <li> <a href="{{route('terms-and-conditions.index')}}">Terms & Conditions</a> </li>
          <li> <a href="{{route('privacy-policy.index')}}">Privacy Policy</a> </li>
          <li> <a href="{{route('gdpr.index')}}">GDPR</a> </li>
          <li> <a href="{{route('about.index')}}">About</a> </li>
          <li> <a href="{{route('faqs.index')}}">Faqs</a> </li>

          <li> <a href="#">My Profile</a> </li>
          <li> <a href="#">Social Media Links</a> </li>
          <li> <a href="#">Contact Details</a> </li>
        </ul>
      </li>
      <!-- /Form Elements -->

      <!-- /Apps -->
    </ul>
    @endrole
    @role('Nutritionist')
    <!-- Logo -->
    <div class="logo-sn ms-d-block-lg">
      <a class="pl-0 ml-0 text-center" href="{{route('home')}}"> <img src="{{asset('backend/assets/img/nutritionist.png')}}" alt="logo"> </a>
    </div>

    <!-- Navigation -->
    <ul class="accordion ms-main-aside fs-14" id="side-nav-accordion">
      @can('product-list')
      <li class="menu-item">
        <a href="{{ route('products.index') }}">
          <span><i class="material-icons fs-16">face</i>Products</span>
        </a>
      </li>
      @endcan
      <li class="menu-item">
        <a href="/chatify">
          <span><i class="fab fa-stack-exchange"></i>Chats</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('intake-substances.index')}}">
          <span><i class="far fa-user-circle"></i>Intake Substances</span>
        </a>
      </li> 
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#form-elements1" aria-expanded="false" aria-controls="form-elements1">
          <span><i class="fas fa-table"></i>Tables</span>
        </a>
        <ul id="form-elements1" class="collapse" aria-labelledby="form-elements1" data-parent="#side-nav-accordion">
          <li> <a href="{{route('assign-table.index')}}">Assign Tables</a></li>
          <li> <a href="{{route('renew-table.index')}}">Renew Tables</a> </li>
        </ul>
      </li>
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#form-elements2" aria-expanded="false" aria-controls="form-elements2">
          <span><i class="fas fa-burn"></i>Workouts</span>
        </a>
        <ul id="form-elements2" class="collapse" aria-labelledby="form-elements2" data-parent="#side-nav-accordion">
          <li><a href="{{route('assign-workout.index')}}">Assign Workout</a></li>
          <li><a href="{{route('renew-workout.index')}}">Renew Workout</a></li>
        </ul>
      </li>    
      <li class="menu-item">
        <a href="{{route('clients.index')}}">
          <span><i class="far fa-user-circle"></i>Active Clients</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('chat.index')}}">
          <span><i class="flaticon-chat"></i></i>client Chats</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('admin-requests.index')}}">
          <span><i class="fa fa-anchor"></i>Admin Request</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('notes.index')}}">
          <span><i class="fa fa-clipboard"></i> Notes</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{url('dashboard/staff-chats')}}">
          <span><i class="fa fa-male"></i>  Staff Chats</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="#">
          <span><i class="material-icons fs-16">equalizer</i>Performance</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{url('dashboard/fullcalendar')}}">
          <span><i class="fa fa-calendar"></i>Calender</span>
        </a>
      </li>

      <!-- Form Elements -->
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#form-elements" aria-expanded="false" aria-controls="form-elements">
          <span><i class="material-icons fs-16">settings</i>Settings</span>
        </a>
        <ul id="form-elements" class="collapse" aria-labelledby="form-elements" data-parent="#side-nav-accordion">
          <li> <a href="#">My Profile</a> </li>
          <li> <a href="#">Social Media Links</a> </li>
          <li> <a href="#">Contact Details</a> </li>
        </ul>
      </li>
      <!-- /Form Elements -->

      <!-- /Apps -->
    </ul>
    @endrole
  </aside>
