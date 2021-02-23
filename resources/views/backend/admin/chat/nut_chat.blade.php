@extends('layouts.app')
@section('head')
<link href="{{asset('backend/assets/css/datatables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css" integrity="sha512-vEia6TQGr3FqC6h55/NdU3QSM5XR6HSl5fW71QTKrgeER98LIMGwymBVM867C1XHIkYD9nMTfWK2A0xcodKHNA==" crossorigin="anonymous" />
<style type="text/css">
    .circle-icon {
    background: #ffc0c0;
    padding:10px;
    border-radius: 50%;
}
</style>
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
                                    @if($recievr->is_blocked) <i style='color:red' title='This Client is blocked' class='fas fa-info-circle'></i> @endif
                                </a>
                            @else
                                <a href="{{route('chat.show', [$recievr->client_id])}}" class="item">
                                    {{ $recievr->firstname }} {{ $recievr->lastname }}
                                    @if($recievr->is_blocked) <i style='color:red' title='This Client is blocked' class='fas fa-info-circle'></i> @endif
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
                        <p>Height: {{ $height }} <a style="float: right;margin-top: -10px" href="{{ Session::get('back_chat_url') }}" class="ms-btn-icon btn-square btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i></a></p>
                    </div>
                </div>

                        
                    </div>
                    <div class="ms-panel-body ms-scrollable">
                        <div class="row">        
                         
                            <div class="col-xl-9 col-md-12 ">
                                <div class="card-body ms-scrollable">
                                    No Chat .....
                                </div>
                                <p id="error-message" style="color: red;text-align: center;">@if($client->is_blocked) Client is Blocked from responding @endif</p>
                                <div class="ms-panel-footer pt-0">
                                    <div class="ms-chat-textbox">
                                        <form id="chat-form">
                                            <ul class="ms-list-flex mb-0">
                                                <li class="ms-chat-input">
                                                    <textarea rows="-3" id="content" name="content" placeholder="Enter Message" ></textarea>
                                                    <div id="pbar_outerdiv" style=" display: none;  width: 195; height: 15px; border: 1px solid grey; z-index: 1; position: relative; border-radius: 5px; -moz-border-radius: 5px;">
                                                        <div id="pbar_innerdiv" style="background-color: lightblue; z-index: 2; height: 100%; width: 0%;"></div>
                                                        <div id="pbar_innertext" style="z-index: 3; position: absolute; top: -4px; left: 0; height: 100%; color: black; font-weight: bold; text-align: center;">0&nbsp;s</div>
                                                        <p>Recording in progress....</p>
                                                    </div>
                                                </li>
                                                <li style="margin-top: -16px; margin-left: 3px;">
                                                    <a class="RecordButton" style="font-size: 20px;" href="javascript:void(0);"><i class="fa fa-microphone circle-icon" aria-hidden="true"></i></a>
                                                <button style="display: none;" title="Record a Message" class=" sendRecordingButton btn btn-primary"><i class="fa fa-microphone fa-5x circle-icon" aria-hidden="true"></i> </button>
                                                 <button style="display: none;" class=" cancelRecordingButton btn btn-primary">Cancel Recording</button>
                                                    <button type="submit" class="sendMessage btn btn-primary">Send</button>
                                                </li>
                                                <input type="hidden" value="0" id="cancelRecording" name="cancelRecording">
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


                        if (chat_content != ' ') {                
                            chat_element += chat_content;
                        }else{
                            chat_element += '<audio controls><source src="'+ childData.recording +'" type="audio/mp3"></audio>';
                        }

                        // chat_element += chat_content;

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
            height: $(window).outerHeight() - 310,
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
                    success: function(data) {
                        $("#error-message").html("");
                        if (data.data == '') {
                            $("#error-message").html("You are blocked by admin to reply!");
                            return;
                        }
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

            $("#content").emojioneArea({
                events: {
                    keyup: function(editor, event) {
                        if (event.which == 13) {
                            $(".emojionearea-editor").blur();
                            $("#chat-form").submit(); 
                        } 
                    }
                }
            });
        });
    </script>

    <script type="text/javascript" src="https://unpkg.com/mic-recorder-to-mp3@2.2.2/dist/index.js"></script>
    <script type="text/javascript">

        var timer = 0,
        timeTotal = 61800,
        timeCount = 20,
        timeStart = 0,
        cFlag;

        const button = document.querySelector('.RecordButton');
        const stopbutton = document.querySelector('.sendRecordingButton');
        const cancelbutton = document.querySelector('.cancelRecordingButton');
        const recorder = new MicRecorder({
            bitRate: 128
        });

        button.addEventListener('click', startRecording);

        function startRecording() {

            clearTimeout(timer);
            cFlag = true;
            timeStart = new Date().getTime();

            recorder.start().then(() => {
                $('#error-message').html('');
                animateUpdate();
                stopbutton.textContent = 'Send Recording';
                $(".cancelRecordingButton").show();
                $(".emojionearea").hide();
                $(".sendMessage").hide();
                $("#pbar_outerdiv").show();
                $("#pbar_outerdiv").trigger('click');
                $('.sendRecordingButton').show();
                $('.RecordButton').hide();
                stopbutton.classList.toggle('btn-danger');
                stopbutton.removeEventListener('click', startRecording);
                stopbutton.addEventListener('click', stopRecording);
            }).catch((e) => {
                $('#error-message').html('Microphone access denied...');
                console.error(e);
            });
        }

        function stopRecording() {
            recorder.stop().getMp3().then(([buffer, blob]) => {
                const file = new File(buffer, 'music.mp3', {
                    type: blob.type,
                    lastModified: Date.now()
                });
                var fd=new FormData();
                fd.append("receiver_id", "{{$receptorUser->id}}");
                fd.append("sender_id", "{{@Auth::user()->id}}");
                fd.append("audio_data",blob, "voice-recording");
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content')
                    },
                    url: "{{ route('save-recording') }}",
                    data: fd,
                    method: 'POST',
                    contentType: false,
                    processData: false,
                    success: function(data) {
                    }
                });

                $(".sendRecordingButton").hide();
                $(".cancelRecordingButton").hide();
                $(".RecordButton").show();
                $(".emojionearea").show();
                $(".sendMessage").show();
                $("#pbar_outerdiv").hide();
                $(".cancelRecordingButton ").hide();
                button.removeEventListener('click', stopRecording);
                button.addEventListener('click', startRecording);    
            }).catch((e) => {
                console.error(e);
            });
        }

        function sendRecording() {
            recorder.stop().getMp3().then(([buffer, blob]) => {
                const file = new File(buffer, 'music.mp3', {
                    type: blob.type,
                    lastModified: Date.now()
                });
            }).catch((e) => {
                console.error(e);
            });
        }


        function updateProgress(percentage) {
            var x = (percentage/timeTotal)*100,
            y = x.toFixed(3);
            var totalSec= (percentage / 1000);
            console.log(percentage);
            var min = parseInt(totalSec/60);
            var sec = parseInt(totalSec%60);
            var hr= parseInt(min/60);
            min = parseInt(min % 60);
            console.log('min',min);
            var  cancelRecording = $("#cancelRecording").val();
            console.log('cancel',cancelRecording);
            if ((percentage == 61800) && (cancelRecording != '1')) {
                stopRecording();
            }
            $('#pbar_innerdiv').css("width", x + "%");
            $('#pbar_innertext').css("left", x + "%").text(min+":"+sec + "");
        }

        function animateUpdate() {
            var perc = new Date().getTime() - timeStart;
            if(perc < timeTotal) {
                updateProgress(perc);
                timer = setTimeout(animateUpdate, timeCount);
            } else {
                updateProgress(timeTotal);
            }
        }

        $(document).ready(function() {
            $('#pbar_outerdiv').click(function() {
                var  cancelRecording = $("#cancelRecording").val();
                if (cancelRecording) {
                }else{
                    if (cFlag == undefined) {
                        clearTimeout(timer);
                        cFlag = true;
                        timeStart = new Date().getTime();
                        animateUpdate();
                    }
                }
            });
        }); 

        $(".cancelRecordingButton").click(function () 
        {
            $("#cancelRecording").val(1);
            stopbutton.textContent = 'Start recording';
            stopbutton.classList.remove('btn-danger');
            stopbutton.classList.add('btn-primary');
            $(".emojionearea").show();
            $(".sendMessage").show();
            $(".sendRecordingButton").hide();
            $(".RecordButton").show();
            $("#pbar_outerdiv").hide();
            $(".cancelRecordingButton ").hide();
            stopbutton.removeEventListener('click', stopRecording);
            stopbutton.addEventListener('click', startRecording);    
        });
    </script>

    @endpush
