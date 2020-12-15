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
                                <p>Weight: {{ @$weight }}</p>
                            </div>
                            <div class="col-sm-2 pt-3">
                                <p>Height: {{ @$height }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="ms-panel-body ms-scrollable">
                        <div class="row"> 
                            <div class="col-xl-9 col-md-12 ">
                                <div class="card-body ms-scrollable">
                                    @if($intake_subs->comments)
                                    @foreach($intake_subs->comments as $intake_sub)
                                    @if(!$intake_sub->comment_by_user)
                                        <div class="ms-chat-bubble ms-chat-message ms-chat-outgoing media clearfix">
                                            <div class="ms-chat-status ms-status-online ms-chat-img">
                                            @if(Auth::user()->avater)
                                                <img style='width:55px; height:45px;' src="/uploads/user/{{ Auth::user()->avater}}" class="ms-img-round" alt="people">
                                            @else                                            
                                                <img style='width:55px; height:45px;' src="/uploads/clients/images/avatar.png" class="ms-img-round" alt="people">
                                            @endif
                                            </div>
                                            <div class="media-body">
                                                <div class="ms-chat-text">
                                                    <p>
                                                        {{ $intake_sub->comment }}
                                                    </p>
                                                </div>
                                                <p class="ms-chat-time">{{ \Carbon\Carbon::parse($intake_sub->created_at)->format('M d, Y H:i a') }}</p>
                                            </div>
                                        </div>
                                        @else
                                        <div class="ms-chat-bubble ms-chat-message ms-chat-incoming media clearfix">
                                            <div class="ms-chat-status ms-status-online ms-chat-img">
                                            @if($client->avatar)
                                                <img style='width:55px; height:45px;' src="/uploads/clients/images/{{ $client->avatar}}" class="ms-img-round" alt="people">
                                            @else
                                                <img style='width:55px; height:45px;' src="/uploads/clients/images/avatar.png" class="ms-img-round" alt="people">
                                            @endif
                                            </div>
                                            <div class="media-body">
                                                <div class="ms-chat-text">
                                                    <p>
                                                       {{ $intake_sub->comment }}
                                                    </p>
                                                </div>
                                                <p class="ms-chat-time"> {{ \Carbon\Carbon::parse($intake_sub->created_at)->format('M d, Y H:i a') }}</p>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                    @endif
                                </div>
                                <div class="ms-panel-footer pt-0">
                                    <div class="ms-chat-textbox">
                                        <form id="chat-form">
                                            <ul class="ms-list-flex mb-0">
                                                <li class="ms-chat-input">
                                                    <input type="text" id="content" name="content" placeholder="Enter Message" value="" >
                                                </li>
                                                <li style="">
                                                    <button type="submit" class="btn btn-primary">Send</button>
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
                    url: '{{ route('intake-substances.store') }}',
                    data: {
                        content: chat_content.val().trim(),
                        intake_substance_id: '{{$id}}'
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
                        window.location.reload();
                        $(".emojionearea-editor").html('');
                        scroll_bottom();
                    }
                }); 
            }

            return false;
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            scroll_bottom();

            /*$("#content").emojioneArea({
                events: {
                    keyup: function(editor, event) {
                        if (event.which == 13) {
                            $(".emojionearea-editor").blur();
                            $("#chat-form").submit(); 
                        } 
                    }
                }
            });*/
        });
    </script>
    @endpush
