@extends('layouts.app')
@section('content')
<div class="col-xl-8 col-md-12">
  <div class="ms-panel ms-panel-fh">
    <div class="ms-panel-header">
      <div class="d-flex justify-content-between">
        <div>
          <h6>All Meeting Notifications</h6>
        </div>
      </div>
    </div>
    <div class="ms-panel-body p-0">
      <ul class="ms-list ms-feed ms-twitter-feed ms-recent-support-tickets">
        @foreach($notifications as $notification)
        <li class="ms-list-item">
            <img src="https://via.placeholder.com/270x270" class="ms-img-round ms-img-small" alt="This is another feature">
            <div class="media-body">
              <div class="d-flex justify-content-between">
                <h4 class="ms-feed-user mb-0">{{$notification->name}}</h4>
                <span class="badge badge-success">@if($notification->seen == 0) Not Seen @else Seen @endif</span>
              </div>
              <span class="my-2 d-block"> <i class="material-icons">date_range</i>{{$notification->date}}</span>
              <p class="d-block">{{$notification->message}}</p>
            </div>
          </a>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
@endsection