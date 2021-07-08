  {{-- -------------------- The default card (white) -------------------- --}}
  @if($viewType == 'default')
  @if($from_id != $to_id)
  <div class="message-card" data-id="{{ $id }}">
    <div class="ms-chat-bubble ms-chat-message ms-chat-incoming media clearfix">
      <div class="ms-chat-status ms-status-online ms-chat-img">
        <img src="https://via.placeholder.com/270x270" class="ms-img-round" alt="people">
      </div>
      <div class="media-body">
        <div class="ms-chat-text">
          <p>

             <span style="font-size: 12px;  text-decoration: underline; color: black;">{{App\Models\User::where('id',$from_id)->value('name')}}</span></br>
            {!! ($message == null && $attachment != null && @$attachment[2] != 'file') ? $attachment[1] : nl2br($message) !!}
          </p>
        </div>
        <p class="ms-chat-time" style="background-color: #fafaff; color: black !important;box-shadow: none; max-width: 100%;">{{ $time }}</p>
        @if(@$attachment[2] == 'file')
        <a href="{{ route(config('chatify.attachments.route'),['fileName'=>$attachment[0]]) }}" class="file-download">
          <span class="fas fa-file"></span> {{$attachment[1]}}</a>
          @endif
        </div>
      </div>
    </div>
    {{-- If attachment is an image --}}
    @if(@$attachment[2] == 'image')
    <div>
      <div class="message-card mc-sender">
        <div class="image-file chat-image" style="width: 250px; height: 150px;background-image: url('{{ asset('storage/'.config('chatify.attachments.folder').'/'.$attachment[0]) }}')">
        </div>
      </div>
    </div>
    @endif
    @endif
    @endif


    @if($viewType == 'sender')
    <div class="message-card mc-sender" data-id="{{ $id }}">
      <div class="ms-chat-bubble ms-chat-message ms-chat-outgoing media clearfix">
         <div class="media-body">
        
        <div class="ms-chat-text">
          <p>
            <span style="font-size: 12px;  text-decoration: underline;">You</span></br>
            {!! ($message == null && $attachment != null && @$attachment[2] != 'file') ? $attachment[1] : nl2br($message) !!}
          </p>
        </div>
        <p class="ms-chat-time" style="background-color: #fafaff; color: black !important;box-shadow: none; max-width: 100%;">{{ $time }}</p>

        @if(@$attachment[2] == 'file')
        <a href="{{ route(config('chatify.attachments.route'),['fileName'=>$attachment[0]]) }}" class="file-download">
          <span class="fas fa-file"></span> {{$attachment[1]}}</a>
          @endif
        </div>
        <div class="ms-chat-status ms-status-online ms-chat-img">
        <img src="https://via.placeholder.com/270x270" class="ms-img-round" alt="people">
      </div>
        @if(@$attachment[2] == 'file')
        <a href="{{ route(config('chatify.attachments.route'),['fileName'=>$attachment[0]]) }}" style="color: #595959;" class="file-download">
          <span class="fas fa-file"></span> {{$attachment[1]}}</a>
          @endif
        </div>
      </div>
      @if(@$attachment[2] == 'image')
      <div>
        <div class="message-card">
          <div class="image-file chat-image" style="width: 250px; height: 150px;background-image: url('{{ asset('storage/'.config('chatify.attachments.folder').'/'.$attachment[0]) }}')">
          </div>
        </div>
      </div>
      @endif
      @endif