@extends('layouts.app')
@section('head')
<title>Admin |Dashboard</title>
<link href="{{asset('backend/assets/css/group_chat.css')}}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="container-fluid h-100">
    <div class="row justify-content-center h-100">
        <div class="col-md-4 col-xl-4 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
            <div class="card-header">
                <div class="rows">

    <div class="col-lg-12">
                    <button type="button" class="btn btn-pill btn-secondary float-right" data-toggle="modal" data-target="#exampleModalCenter">
                        + Group
                    </button>
                </div>
                </div>
            </div>
            <hr>
            <div class="card-body contacts_body">
                <ul class="contacts">
                    @foreach($groups as $group)
                    <a href="{{route('groups.show',$group->id)}}">
                        @if(isset($group_id))
                        @if ($group->id == $group_id)
                        <li class="active">
                            @endif
                            @else
                            <li>
                                @endif
                                <div class="d-flex bd-highlight" style="margin: 0px 10px; margin-top: -5px; margin-bottom: 12px;">
                                    <div class="img_cont">
                                        <img src="{{asset('backend/assets/img/avater.png')}}" class="rounded-circle user_img">
                                    </div>
                                    <div class="user_info">
                                        <span>{{$group->name}}</span>   
                                    </div>
                                </div>
                            </li>
                        </a>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer"></div>
            </div></div>
            @if(isset($group_id))
            <div class="col-md-8 col-xl-8 chat">
                <div class="card">
                    <div class="card-header msg_head">
                        <div class="d-flex bd-highlight">
                            <div class="img_cont">
                                <img src="{{asset('backend/assets/img/avater.png')}}" class="rounded-circle user_img">
                                <span class="online_icon"></span>
                            </div>
                            <div class="user_info">
                                <span>{{$group_name}}</span>
                                <p>{{$count}} messages</p>
                            </div>
                            <!-- Button trigger modal -->
                            <button type="button" id="action_menu_btn"class="btn btn-pill btn-secondary float-right" data-toggle="modal" data-target="#exampleModal2" ><i class="fas fa-eye"></i> Participants

                            </button>

                        </div>
                    </div>
                    <div class="card-body msg_card_body" id="msg_card_body">
                        @foreach($conversations as $conversation)
                        @if($conversation->user->id == Auth::User()->id)
                        <div class="d-flex justify-content-start mb-4 conversation">
                            <div class="img_cont_msg">
                                <p>{{$conversation->user->name}}</p>
                            </div>
                            <div class="msg_cotainer">
                                {{$conversation->message}}
                                <span class="msg_time">8:40 AM, Today</span>
                            </div>
                        </div>
                        @else
                        <div class="d-flex justify-content-end mb-4">
                            <div class="msg_cotainer_send">
                                {{$conversation->message}}
                                <span class="msg_time_send">8:55 AM, Today</span>
                            </div>
                            <div class="img_cont_msg">
                             <p> {{$conversation->user->name}} </p>
                         </div>
                     </div>
                     @endif
                     @endforeach
                 </div>
                 <div class="card-footer">

                    <div class="input-group">
                        <form id="messageForm" class="col-sm-12">
                        {{-- <div class="input-group-append">
                            <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                        </div> --}}
                        <textarea name="" class="form-control type_msg" id="message" placeholder="Type your message..."></textarea>
                        <input type="hidden" name="group_id" id="group_id" value="{{$group_id
                        }}">
                        <div class="input-group-append pull-right">
                            <button type="submit" class="btn btn-secondary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @else
    <div class="col-md-8 col-xl-6 chat">
        <div class="card-header msg_head">
            <div class="d-flex bd-highlight">
                <p class="text-center">Select Group to start Chat</p>
            </div>
        </div>
        <div class="card-body msg_card_body">
            <div class="d-flex justify-content-start mb-4">
            </div>
        </div> 
    </div>
    @endif
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Create Group</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form method="POST" action="{{route('groups.store')}}">
    @csrf
    <div class="modal-body">
      <div class="form-group">
        <label for="recipient-name" class="col-form-label">Group name:</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="form-group">
        <label for="message-text" class="col-form-label">Add Participants:</label>
        <div class="input-group-text">
            <select class="js-example-basic-multiple" name="users[]" multiple="multiple" style="width: 100%">
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{$user->name }}</option>
                @endforeach
            </select>
            
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save</button>
</div>
</form>
</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Participants</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Action</th>
  </tr>
</thead>
<tbody>
    @if(!empty($participants))
    @foreach($participants as $participant)
    <tr>
      <th scope="row">1</th>
      <td>{{$participant->name}}</td>
      <td><button class="btn btn-danger" id="buttonremove" value="{{ $participant->id }}"><i class="fas fa-user-minus"></i></button></td>
  </tr>
  @endforeach
  @endif
</tbody>
</table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary">Save changes</button>
</div>
</div>
</div>
</div>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
    $(document).ready(function () {
        $('.conv ').animate({
            scrollTop: $('.msg_card_body .conversation:last-child').position().top
        }, 'slow');
    });
    $('#messageForm').on('submit',function(event){
        event.preventDefault();
        let message = $('#message').val();
        let group_id = $('#group_id').val();
        if (message  === '') {
            alert('Text-field is empty.');
            return false;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ route('conversations.store') }}",
            method: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                message: message,
                user_id: {{Auth::User()->id}},
                group_id:group_id,
            },
            success: function(result){
               window.setTimeout(function () {
                  window.location.reload();
              }, 30);
           }
       });
    });


    $(document).ready(function() { 
    $('#buttonremove').click(function() { 
        var text = $(this).attr('value'); 
        alert(text); 
    }); 
}); 
</script>
@endpush
@endsection