@extends('layouts.app')
@section('head')
<link href="{{asset('backend/assets/css/datatables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css" integrity="sha512-vEia6TQGr3FqC6h55/NdU3QSM5XR6HSl5fW71QTKrgeER98LIMGwymBVM867C1XHIkYD9nMTfWK2A0xcodKHNA==" crossorigin="anonymous" />
<div id="app" class="ui main container" >
    <div class="ui grid">
        <div class="row"> 
            <div class="col-xl-3 col-md-12">
          <div class="ms-panel ms-panel-fh">
            <div class="ms-panel-body py-3 px-0">
              <div class="ms-chat-container">

                <div class="ms-chat-header px-3">
                  <div class="ms-chat-user-container media clearfix">
                    <div class="ms-chat-status ms-status-online ms-chat-img mr-3 align-self-center">
                      @if($receptorUser->avatar)
                            <img style='width:55px; height:45px;' src="/uploads/clients/images/{{ $receptorUser->avatar}}" class="ms-img-round" alt="people">
                            @else
                            <img style='width:55px; height:45px;' src="/uploads/clients/images/avatar.png" class="ms-img-round" alt="people">
                            @endif
                    </div>
                    <div class="media-body ms-chat-user-info mt-1">
                      <h6>{{ ucfirst($receptorUser->firstname) }} {{ ucfirst($receptorUser->lastname) }}</h6>
                      <a href="#" class="text-disabled has-chevron fs-12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Available
                      </a>
                    </div>
                  </div>
                  <form class="ms-form my-3" method="post">
                    <div class="ms-form-group my-0 mb-0 has-icon fs-14">
                      <input type="search" class="ms-form-input w-100" name="search" placeholder="Search ....." value="">
                      <i class="flaticon-search text-disabled"></i>
                    </div>
                  </form>
                </div>

                <div class="ms-chat-body">
                  <ul class="nav nav-tabs tabs-bordered d-flex nav-justified px-3" role="tablist">
                    <li role="presentation" class="fs-12"><a href="#chats-2" aria-controls="chats" class="active show" role="tab" data-toggle="tab">  </a></li>
                    
                  </ul>

                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active show fade in" id="chats-2">
                      <ul class="ms-scrollable" style="height: 450px;">
                        @foreach($clients as $recievr)
                            
                        <li class="ms-chat-user-container ms-open-chat ms-deletable p-3 media clearfix">
                          <div class="ms-chat-status ms-status-away ms-has-new-msg ms-chat-img mr-3 align-self-center">
                            <!-- <span class="msg-count">3</span> -->

                            @if($recievr->avatar)
                            <img style='width:55px; height:45px;' src="/uploads/clients/images/{{ $recievr->avatar}}" class="ms-img-round" alt="people">
                            @else
                            <img style='width:55px; height:45px;' src="/uploads/clients/images/avatar.png" class="ms-img-round" alt="people">
                            @endif

                          </div>
                          <div class="media-body ms-chat-user-info mt-1">
                            <h6>
                                @if($recievr->client_id == $receptorUser->id)
                                <a href="{{route('chat.show', [$recievr->client_id])}}" class="active item">
                                    {{ $recievr->firstname }} {{ $recievr->lastname }}
                                </a>
                            @else
                                <a href="{{route('chat.show', [$recievr->client_id])}}" class="item">
                                    {{ $recievr->firstname }} {{ $recievr->lastname }}
                                </a>
                            @endif
                            </h6>
                          </div>
                        </li>

                      @endforeach
                      </ul>

                    </div>
                  </div>

                </div>

              </div>
            </div>
          </div>
        </div>         
            <div class="col-xl-9 col-md-12">
                <div class="ms-panel ms-chat-conversations ms-widget">
                    <div class="ms-panel-header">

                        <div class="row">
                    <div class="col-sm-2">
                        <div class="ms-chat-user-container media clearfix">
                                <div class="ms-chat-status ms-status-online ms-chat-img mr-3 align-self-center">
                                    @if($client->avatar)
                                    <img style='width:55px; height:45px;' src="/uploads/clients/images/{{ $client->avatar}}" class="ms-img-round" alt="people">
                                    @else
                                    <img style='width:55px; height:45px;' src="/uploads/clients/images/avatar.png" class="ms-img-round" alt="people">
                                    @endif
                                </div>
                                <div class="media-body ms-chat-user-info mt-1">
                                    <p><b>{{$client->firstname}} {{$client->lastname}}</b></p>

                                </div>
                            </div>
                    </div>
                    <div class="col-sm-2 pt-3">
                        <p>ID: NJMF{{$client->id}}</p>
                    </div>
                    <div class="col-sm-2 pt-3">
                        <p>Gender: {{ucfirst($client->gender)}}</p>
                    </div>
                    <div class="col-sm-2 pt-3">
                        <p>Age: 26 Years</p>
                    </div>
                    <div class="col-sm-2 pt-3">
                        <p>Weight: {{ $weight }}</p>
                    </div>
                    <div class="col-sm-2 pt-3">
                        <p>Height: {{ $height }}</p>
                    </div>
                </div>

                        
                    </div>
                    <div class="ms-panel-body ms-scrollable">
                        <div class="row">        
                         
                            <div class="col-xl-9 col-md-12 ">
                                <div class="card-body ms-scrollable">
                                    No Chat .....
                                </div>
                                <div class="ms-panel-footer pt-0">
                                    <div class="ms-chat-textbox">
                                        <form id="chat-form">
                                            <ul class="ms-list-flex mb-0">
                                                <li class="ms-chat-input">
                                                    <input type="text" id="content" name="content" placeholder="Enter Message" value="" >
                                                </li>
                                                <li style="margin-top: -16px; margin-left: 3px;">
                                                    <button class="btn btn-primary">Send</button>
                                                </li>
                                            </ul>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-12" style="border: 1px dotted #00ff08;">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>Diet</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$package}}</td>       
                                        </tr>
                                        <tr>
                                            <td>{{@$client_table->calories}} Calories</td>        
                                        </tr>
                                        <tr>
                                            <td>{{@$client_table->carbs}}g Carbs</td>       
                                        </tr>
                                        <tr>
                                            <td>{{@$client_table->protein}}g Protein</td>       
                                        </tr>
                                        <tr>
                                            <td>{{@$client_table->fat}}g Fat</td>       
                                        </tr>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th>Workout</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Yoga</td>       
                                        </tr>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th>Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>.....</td>       
                                        </tr>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://www.gstatic.com/firebasejs/4.9.1/firebase.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js" integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA==" crossorigin="anonymous"></script>
<script>
    var old_users_val = $(".users").html();
    var scroll_bottom = function() {
        var card_height = 0;
        $('.card-body .chat-item').each(function() {
            card_height += $(this).outerHeight();
        });
        $(".card-body").scrollTop(card_height);
    }

    var escapeHtml = function(unsafe) {
        return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
    }

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

        // chats

        var id3 = "{{ Auth::user()->id }}_{{ $receptorUser->id }}";
       firebase.database().ref('/chats').orderByChild("sender_receiver").equalTo(id3.trim()).on('value', function(snapshot) {
            var chat_element = "";
            if(snapshot.val() != null) {
                snapshot.forEach(function(childSnapshot) {
                    // console.log('dd',childSnapshot.val().id);
                    firebase.database().ref('/chats').child(childSnapshot.val().id).update({'is_read' : 1});
                    var childData = childSnapshot.val();
                    var sender_receiver = childData.sender_receiver;
                    if (sender_receiver.trim() == id3.trim()) {
                        var chat_name = childData.name,
                        chat_content = escapeHtml(childData.content);
                        if (childData.sender_id == '{{ $receptorUser->id }}' && childData.message_from == 'user') {
                            chat_element += '<div class="chat-item ms-chat-bubble ms-chat-message media ms-chat-incoming clearfix '+childData.type+'">';
                            @if($client->avatar)
                             chat_element += '<div class="chat-item ms-chat-status ms-status-online ms-chat-img">'+
                        '<img style="width:48px; height:48px;"48px src="/uploads/clients/images/{{ $client->avatar}}" class="ms-img-round"  alt="people">'+
                        '</div>';
                        @else
                        chat_element += '<div class="ms-chat-status ms-status-online ms-chat-img">'+
                        '<img style="width:48px; height:48px;" src="/uploads/clients/images/avatar.png" class="ms-img-round" alt="people">'+
                        '</div>';
                        @endif
                        }else{
                            chat_element += '<div class="chat-item ms-chat-bubble ms-chat-message ms-chat-outgoing media clearfix '+childData.type+'">';
                             chat_element += '<div class="ms-chat-status ms-status-online ms-chat-img">'+
                        '<img src="/uploads/user/{{ Auth::user()->avater}}"  alt="people">'+
                        '</div>';
                        }
                        chat_element += '<div class="media-body">';

                        chat_element += '<div class="ms-chat-text"><p>';                
                        chat_element += chat_content;

                        chat_element += '</p></div>';

                        let current_datetime = new Date(childData.timestamp);

                        var monthShortNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                        ];


                        console.log(current_datetime.getMinutes());
                        let formatted_date = (monthShortNames[current_datetime.getMonth()])+ " " + current_datetime.getDate() + ", " + current_datetime.getFullYear() + " " +  current_datetime.getHours() + ":" + current_datetime.getMinutes() + " " + (current_datetime.getHours() >= 12 ? 'pm' : 'am');
                        var date1 = new Date(childData.timestamp);
                        var date2 = new Date();
                        var timeDiff = Math.abs(date2.getTime() - date1.getTime());
                        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));


                        chat_element += '<p class="ms-chat-time" style="color:grey">';
                        if (diffDays > 1) {
                            chat_element += diffDays;
                            chat_element += ' days ago';
                        }else{
                            chat_element += formatted_date;
                        }
                        chat_element += '</p>';

                        chat_element += '</div>';

                        chat_element += '</div>';
                        $(".card-body").html(chat_element);
                    }else{
                        //$(".card-body").html('<i>No chat</i>')
                    }
                });
            }else{
                $(".card-body").html('<i>No chat</i>')
            }

            scroll_bottom();
        }, function(error) {
            alert('ERROR! Please, open your console.')
            console.log(error);
        });

        // Set the card height equal to the height of the window
        $(".card-body").css({
            height: $(window).outerHeight() - 290,
            overflowY: 'auto'
        });

        // #chat-form action handler
        $("#chat-form").submit(function() {
            var me = $(this),
            chat_content = me.find('[name=content]');

            if(chat_content.val().trim().length <= 0) {
                $(".emojionearea-editor").focus();
                    chat_content.focus();
            }else{
                $.ajax({
                    url: '{{ route('chat.store') }}',
                    data: {
                        content: chat_content.val().trim(),
                        receiver_id: '{{$receptorUser->id}}'
                    },
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content')
                    },
                    beforeSend: function() {
                        $("#chat-form button").prop('disabled', true);
                    },
                    complete: function() {
                        $("#chat-form button").prop('disabled', false);
                    },
                    success: function() {
                        chat_content.val('');
                        chat_content.focus();
                        $(".emojionearea-editor").html('');
                        scroll_bottom();
                    }
                });
            }

            return false;
        });

        var timer;
        $("#chat-form [name=content]").keyup(function() {
            var ref = firebase.database().ref('typing');
            ref.set({
                name: user_name
            });

            timer = setTimeout(function() {
                ref.remove();
            }, 2000);
        });
    </script>

        <script type="text/javascript">
  $(document).ready(function() {
    $("#content").emojioneArea();
  });

  $(function(){

    $('input[type="search"]').keyup(function(){
        
        var searchText = $(this).val().toLowerCase();
        
        $('#chats-2 ul > li').each(function(){
            
            var currentLiText = $(this).text().toLowerCase(),
                showCurrentLi = currentLiText.indexOf(searchText) !== -1;
            
            $(this).toggle(showCurrentLi);
            
        });     
    });

});
</script>
    @endpush
