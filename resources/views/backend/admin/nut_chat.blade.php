@extends('layouts.app')
@section('head')
<link href="{{asset('backend/assets/css/datatables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css" integrity="sha512-vEia6TQGr3FqC6h55/NdU3QSM5XR6HSl5fW71QTKrgeER98LIMGwymBVM867C1XHIkYD9nMTfWK2A0xcodKHNA==" crossorigin="anonymous" />
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
                        <p>Height: {{ $height }}</p>
                    </div>
                </div>

                        
                    </div>
                    <div class="ms-panel-body ms-scrollable">
                        <div class="row">           
                            <div class="col-xl-9 col-md-12 ">
                                <div class="card-body ms-scrollable">
                                    loading chats .....
                                </div>
                                <div class="ms-panel-footer pt-0">
                                    <div class="ms-chat-textbox">
                                        <form id="chat-form">
                                            <ul class="ms-list-flex mb-0">
                                                <li class="ms-chat-input">
                                                    <input type="text" id="content" name="content" placeholder="Enter Message" value="">
                                                </li>
                                                <li>
                                                    <input type="hidden" name="file_name" id="file_name" value="">
                                                    <input type="hidden" name="file_path" id="file_path" value="">
                                                    <li><div class="addFiles" style="display: none;"><input id="file"  type="file" name="file"></div>
                                                    </li>
                                                    <li> <button style="margin-top: -10px;margin-bottom: -2px" class="btn btn-primary">Send</button></li>
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
                                            <td>{{$client_table->carbs}}g Carbs</td>       
                                        </tr>
                                        <tr>
                                            <td>{{$client_table->protein}}g Protein</td>       
                                        </tr>
                                        <tr>
                                            <td>{{$client_table->fat}}g Fat</td>       
                                        </tr>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th>Workout</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Yoga:</td>       
                                        </tr>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th>Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Pakage Name:</td>       
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
        var users_name = [];
        var id1 = "{{ $receptorUser->id }}";
        var id2 = "{{ Auth::user()->id }}";
        var id3 = "{{ Auth::user()->id }}_{{ $receptorUser->id }}";
       firebase.database().ref('/chats').orderByChild("sender_receiver").equalTo(id3.trim()).on('value', function(snapshot) {
        console.log(snapshot.val());
            var chat_element = "";
            if(snapshot.val() != null) {
                snapshot.forEach(function(childSnapshot) {
                    console.log(childSnapshot.val());
                    var childData = childSnapshot.val();
                    var sender_receiver = escapeHtml(childData.sender_receiver);
                    if (sender_receiver.trim() == id3.trim()) {
                        var chat_name = childData.name,
                        chat_content = escapeHtml(childData.content);
                        users_name[`index`] = chat_name;
                        if (childData.sender_id == '{{ $receptorUser->id }}') {
                            chat_element += '<div class="chat-item ms-chat-bubble ms-chat-message media ms-chat-incoming clearfix '+childData.type+'">';
                            @if($client->avatar)
                             chat_element += '<div class="chat-item ms-chat-status ms-status-online ms-chat-img">'+
                        '<img src="/uploads/clients/images/{{ $client->avatar}}"  alt="people">'+
                        '</div>';
                        @else
                        chat_element += '<div class="ms-chat-status ms-status-online ms-chat-img">'+
                        '<img style='width:55px; height:55px;' src="https://via.placeholder.com/270x270" class="ms-img-round" alt="people">'+
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

                        if (childData.file_name && childData.file_name != '') {
                            chat_element += '<br>';
                            chat_element += '<a target="_blank" href="' + childData.file_path + '">' + childData.file_name + '</a>';
                        }
                        chat_element += '</p></div>';

                        let current_datetime = new Date(childData.timestamp);
let formatted_date = current_datetime.getDate() + "-" + (current_datetime.getMonth() + 1)+ "-" + current_datetime.getFullYear() + " " +  current_datetime.getHours() + ":" + current_datetime.getMinutes() + ":" + current_datetime.getSeconds() 

                        chat_element += '<p class="ms-chat-time">';
                        chat_element += formatted_date;
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
            height: $(window).outerHeight() - 200,
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
                    url: '{{ route('chat.store') }}',
                    data: {
                        content: chat_content.val().trim(),
                        receiver_id: '{{$receptorUser->id}}',
                        file_name: document.getElementById("file_name").value,
                        file_path: document.getElementById("file_path").value,
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
                    success: function() {
                        chat_content.val('');
                        document.getElementById("file").value=null; 
                        document.getElementById("file_name").value=null; 
                        document.getElementById("file_path").value=null; 
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
                    console.log(snapshot);
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
                document.getElementById('file').addEventListener('change', handleFileSelect, false);
            }
        </script>
        <script type="text/javascript">
  $(document).ready(function() {
    $("#content").emojioneArea();
  });
</script>
    @endpush
