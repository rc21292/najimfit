@extends('layouts.app')
@section('head')
<title>Admin |Dashboard</title>
@endsection
@role('Admin')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css" integrity="sha512-vEia6TQGr3FqC6h55/NdU3QSM5XR6HSl5fW71QTKrgeER98LIMGwymBVM867C1XHIkYD9nMTfWK2A0xcodKHNA==" crossorigin="anonymous" />
<style type="text/css">
.circle-icon {
    background-color: #45e345 !important; 
    color: white !important;
    background: #ffc0c0;
    padding:10px;
    border-radius: 50%;
    font-size: 18px;
}
</style>
<div id="app" class="ui main container" >
    <div class="ui grid">
        <div class="row">           
            <div class="col-xl-12 col-md-12">
                <div class="ms-panel ms-chat-conversations ms-widget">
                    <div class="ms-panel-header">

                        <div class="row">
                    <div class="col-sm-2">
                        <div class="ms-chat-user-container media clearfix">
                                <div class="ms-chat-status ms-status-online ms-chat-img mr-3 align-self-center">
                                    @if($client->avatar)
                                    <img style='width:55px; height:55px;' src="/uploads/clients/images/{{ $client->avatar}}" class="ms-img-round" alt="people">
                                    @else
                                    <img style='width:55px; height:55px;' src="https://via.placeholder.com/270x270" class="ms-img-round" alt="people">
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
                        <p>Height: {{ $height }} <a style="float: right;margin-top: -10px" href="{{ URL::previous() }}" class="ms-btn-icon btn-square btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i></a></p>
                    </div>
                </div>

                        
                    </div>
                    <div class="ms-panel-body ms-scrollable">
                        <div class="row">           
                            <div class="col-xl-9 col-md-12 ">
                                <div class="card-body ms-scrollable">
                                    loading chats .....
                                </div>
                                <p id="error-message" style="color: red;text-align: center;">@if($client->is_blocked) Client is Blocked from responding @endif</p>
                                <div class="ms-panel-footer pt-0">
                                    <div class="ms-chat-textbox">
                                        <form id="chat-form">
                                            <ul class="ms-list-flex mb-0">
                                                <li class="ms-chat-input">
                                                    <textarea rows="-3" id="content" name="content" placeholder="Enter Message" ></textarea>
                                                    <div id="pbar_outerdiv" style="width: 94%; display: none;  width: 195; height: 15px; border: 1px solid grey; z-index: 1; position: relative; border-radius: 5px; -moz-border-radius: 5px;">
                                                        <div id="pbar_innerdiv" style="background-color: lightblue; z-index: 2; height: 100%; width: 0%;"></div>
                                                        <div id="pbar_innertext" style="z-index: 3; position: absolute; top: -4px; left: 0; height: 100%; color: black; font-weight: bold; text-align: center;">0&nbsp;s</div>
                                                        <p>Recording in progress....</p>
                                                    </div>
                                                </li>
                                                <li style=" margin-left: 3px;">
                                                    <a title="Record a voice message" class="RecordButton" href="javascript:void(0);"><i class="fa fa-microphone circle-icon" aria-hidden="true"></i></a>
                                                    <a style="display: none;" title="Send audio message" class=" sendRecordingButton"><i class="fa fa-paper-plane circle-icon" aria-hidden="true"></i> </a>
                                                    <a title="Cancel Recording" style="display: none;" class=" cancelRecordingButton"><i class="fa fa-times circle-icon" aria-hidden="true"></i></a>
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
                                            <td>{{@$package}}</td>       
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
                                        @if(count($notes) > 0)
                                        @foreach($notes as $note)
                                        <tr>
                                            <td>{{$note->note}}</td>       
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td>....</td>       
                                        </tr>
                                        @endif
                                       
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
@endrole


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
        var users_name = [];
        var id3 = "{{ @$senderUser->id }}_{{ @$receptorUser->id }}";
     firebase.database().ref('/chats').orderByChild("sender_receiver").equalTo(id3.trim()).on('value', function(snapshot) {
            var chat_element = "";
            if(snapshot.val() != null) {
                snapshot.forEach(function(childSnapshot) {
                    var childData = childSnapshot.val();
                    var sender_receiver = childData.sender_receiver;
                    if (sender_receiver.trim() == id3.trim()) {
                        var chat_name = childData.name,
                        chat_content = escapeHtml(childData.content);
                        if (childData.sender_id == '{{ @$receptorUser->id }}' && childData.message_from == 'user') {
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
                        '<img src="/uploads/user/{{ @$senderUser->avater}}"  alt="people">'+
                        '</div>';
                        }
                        chat_element += '<div class="media-body">';

                        if (chat_content != ' ') {                
                        chat_element += '<div class="ms-chat-text"><p>';
                        chat_element += chat_content;
                    }else{
                        chat_element += '<div class="ms-chat-text"><p>';
                         chat_element += '<audio id="audio" controls><source src="'+ childData.recording +'" type="audio/mp3"></audio>';
                    }

                        chat_element += '</p></div>';

                        let current_datetime = new Date(childData.timestamp);

                        var monthShortNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                        ];



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

       

        firebase.database().ref('/typing').on('value', function(snapshot) {
            var user = snapshot.val();
            if(user && user.name != user_name) {
                $(".users").html(user.name + ' is typing');
            }else{
                $(".users").html(old_users_val);
            }
        });

        // Get user name from localStorage
        var user_name = localStorage.getItem('user_name');
        // If the user hasn't set their name
        var myModal;
        if(!user_name) {
            // Show modal
            myModal = $('#myModal').modal({
                backdrop: 'static'
            });

        }

        // #logout action handler
        $("#logout").click(function() {
            var ask = confirm('Are you sure?');
            if(ask) {
                localStorage.removeItem("user_name");
                location.reload();
            }
            return false;
        });

        // Set the card height equal to the height of the window
        $(".card-body").css({
            height: $(window).outerHeight() - 310,
            overflowY: 'auto'
        });

        // #chat-form action handler
        $("#chat-form").submit(function() {
            var me = $(this),
            chat_content = me.find('[name=content]'),
            user_name = localStorage.getItem('user_name');

            if(chat_content.val().trim().length <= 0) {
                $(".emojionearea-editor").focus();
                    chat_content.focus();
            }else{
                $.ajax({
                    url: '{{ route('client-chats.store') }}',
                    data: {
                        content: chat_content.val().trim(),
                        sender_id: '{{@$senderUser->id}}',
                        receiver_id: '{{@$receptorUser->id}}'
                    },
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content')
                    },
                    beforeSend: function() {
                        chat_content.attr('disabled', true);
                    },
                    complete: function() {
                        chat_content.attr('disabled', false);
                    },
                    success: function(data) {
                        if (data.data == '') {
                            $("#error-message").html("Admin blocked you to reply for this client.");
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

    <script>
            var storageRef = firebase.storage().ref();
 
            function handleFileSelect(evt) {
                evt.stopPropagation();
                evt.preventDefault();
                $("#chat-form button").prop('disabled', true);
                var file = evt.target.files[0];
 
                var metadata = {
                    'contentType': file.type
                };

                storageRef.child('images/' + file.name).put(file, metadata).then(function (snapshot) {

                    snapshot.ref.getDownloadURL().then(function (url) {
                        document.getElementById('file_path').value = url;
                        document.getElementById('file_name').value = file.name;
                        $("#chat-form button").prop('disabled', false);
                    });
                }).catch(function (error) {
                    console.error('Upload failed:', error);
                });
            }
 
            window.onload = function () {
            }
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
                $('#error-message').html('');

            recorder.start().then(() => {
                animateUpdate();
                $("#cancelRecording").val(0);
                $(".cancelRecordingButton").show();
                $(".emojionearea").hide();
                $(".sendMessage").hide();
                $("#pbar_outerdiv").show();
                $("#pbar_outerdiv").trigger('click');
                $('.sendRecordingButton').show();
                $('.RecordButton').hide();
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
                fd.append("receiver_id", "{{@$receptorUser->id}}");
                fd.append("sender_id", "{{@$senderUser->id}}");
                fd.append("audio_data",blob, "voice-recording");
                var  cancelRecording = $("#cancelRecording").val();
                if ((cancelRecording != '1')) {

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
                }

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
            var min = parseInt(totalSec/60);
            var sec = parseInt(totalSec%60);
            var hr= parseInt(min/60);
            min = parseInt(min % 60);
            var  cancelRecording = $("#cancelRecording").val();

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
            stopRecording();
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