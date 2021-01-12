@extends('layouts.app') 
@section('head')
<title>Admin |Dashboard</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css" integrity="sha512-vEia6TQGr3FqC6h55/NdU3QSM5XR6HSl5fW71QTKrgeER98LIMGwymBVM867C1XHIkYD9nMTfWK2A0xcodKHNA==" crossorigin="anonymous" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
	li.active{
		background-color: #e0e0e2;
	}
</style>
@endsection
@section('content')
<div class="ui main container" >
	<div class="ui grid">
		<div class="row">
			<div class="col-xl-4 col-md-12">
				<div class="ms-panel ms-panel-fh ms-widget">
					<div class="ms-panel-header">
						<div class="ms-chat-header justify-content-between">
							<div class="ms-chat-user-container media clearfix">
								<button type="button" class="btn btn-pill btn-secondary float-right" data-toggle="modal" data-target="#exampleModalCenter">+ Group</button>
							</div>
						</div>
					</div>
					<div class="ms-panel-body">
						<ul class="ms-followers ms-list ms-scrollable ps">
							@foreach($groups as $group)
							<a href="{{route('groups.show',$group->id)}}">
								<li class="ms-list-item media @if(isset($group_id)) @if($group->id == $group_id) active @endif @endif">
									<img src="https://via.placeholder.com/270x270" class="ms-img-small ms-img-round" alt="people">
									<div class="media-body mt-1">
										<h4>{{ $group->name }}</h4>
										<span class="fs-12">Created {{$group->created_at->diffForHumans()}}</span>
									</div>
								</li>
							</a>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
			<!-- Chat Widget -->
			@if(isset($group_id))
			<div class="col-xl-8 col-md-12">
				<div class="ms-panel ms-panel-fh ms-widget ms-chat-conversations">
					<div class="ms-panel-header">
						<div class="ms-chat-header justify-content-between">
							<div class="ms-chat-user-container media clearfix">
								<div class="ms-chat-status ms-status-online ms-chat-img mr-3 align-self-center">
									<img src="https://via.placeholder.com/270x270" class="ms-img-round" alt="people">
								</div>
								<div class="media-body ms-chat-user-info mt-1">
									<h6>{{$group_name}}</h6>
									<span class="text-disabled fs-12">
										{{$count}} messages
										<input type="hidden" name="message_count" id="message_count" value="{{ $count }}">
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="ms-panel-body ms-scrollable" id="message_body">
						@foreach($conversations as $conversation)
						@if($conversation->user->id == Auth::User()->id)
						<div class="ms-chat-bubble ms-chat-message ms-chat-outgoing media clearfix">
							<div class="ms-chat-status ms-status-online ms-chat-img">
								<img src="{{asset('backend/assets/img/avatar.png')}}" alt="people">
							</div>
							<div class="media-body">
								<div class="ms-chat-text">
									<p>
										{{ $conversation->message}}
									</p>
								</div>
								<p class="ms-chat-time">{{ $conversation->created_at->diffForHumans()}}</p>
							</div>
						</div>
						@else
						<div class="ms-chat-bubble ms-chat-message ms-chat-incoming media clearfix">
							<div class="ms-chat-status ms-status-online ms-chat-img">
								<img src="{{asset('backend/assets/img/avater.png')}}" alt="people">
							</div>
							<div class="media-body">
								<div class="ms-chat-text">
									<p>
										{{ $conversation->message}}
									</p>
								</div>
								<p class="ms-chat-time">{{ $conversation->created_at->diffForHumans()}}</p>
							</div>
						</div>
						@endif
						@endforeach
					</div>
					<div class="ms-panel-footer">
						<div class="ms-chat-textbox">
							<form id="chat-form">
								<ul class="ms-list-flex mb-0">
									<li class="ms-chat-input">
										<input type="text" id="content" name="content" placeholder="Enter Message" value="" >
										@if(isset($group_id))
										<input type="hidden" name="group_id" id="group_id" value="{{$group_id
										}}">
										@endif
									</li>
									<li style="margin-top: -16px; margin-left: 3px;">
										<button type="submit" class="btn btn-primary">Send</button>
									</li>
								</ul>
							</form>
						</div>
					</div>
				</div>
			</div>
			@else
			<div class="col-xl-8 col-md-12">
				<div class="d-flex justify-content-center" style="margin-top:150px;">Please Select Group to Start Chatting</div>
			</div>
			@endif
		</div>
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
							{{--       <th scope="col">Action</th> --}}
						</tr>
					</thead>
					<tbody>
						@if(!empty($participants))
						@foreach($participants as $participant)
						<tr>
							<th scope="row">1</th>
							<td>{{$participant->name}}</td>
							{{-- <td><button class="btn btn-danger" id="buttonremove" value="{{ $participant->id }}"><i class="fas fa-user-minus"></i></button></td> --}}
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
	@endsection
	@push('scripts')
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js" integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA==" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.js-example-basic-multiple').select2();
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
	<script type="text/javascript">
		$('#chat-form').on('submit',function(event){
			event.preventDefault();
			let message = $('#content').val();
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
					console.log(result);
					// window.setTimeout(function () {
					// 	window.location.reload();
					// }, 30);
				}
			});
		});

	</script>
	<script>
		function fetchdata(){
			let message_count = $('#message_count').val();
			let group_id = $('#group_id').val();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			jQuery.ajax({
				url: "{{ route('conversations.create') }}",
				method: 'get',
				data: {
					"_token": "{{ csrf_token() }}",
					message_count: message_count,
					group_id:group_id,
				},
				success: function(response){
					if(response.success != 0){
						$("#message_body .ps__rail-x:last").before('<div class="ms-chat-bubble ms-chat-message ms-chat-incoming media clearfix"><div class="ms-chat-status ms-status-online ms-chat-img"><img src="{{asset('backend/assets/img/avater.png')}}" alt="people"></div><div class="media-body"><div class="ms-chat-text"><p>'+response.success.message+'</p></div><p class="ms-chat-time">'+response.success.created_at+'</p></div></div>');
						$('#message_count').val(response.new_count);
					}else{

					}
   // Perform operation on the return value
}
});
		}

		$(document).ready(function(){
			setInterval(fetchdata,2000);
		});
	</script>
	@endpush