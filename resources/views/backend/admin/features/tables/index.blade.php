@extends('layouts.app')
@section('head')
<link href="{{asset('backend/assets/css/datatables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-sm-6">
				<nav aria-label="breadcrumb " class="ms-panel-custom">
					<ol class="breadcrumb pl-0">
						<li class="breadcrumb-item"><a href="/"><i class="material-icons">home</i> Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Meal List</li>
					</ol>
				</nav>
			</div>
			<div class="col-sm-6" style="padding-left: 85px;">
				<button class="btn btn-square btn-danger delete_all mb-2" data-url="{{ url('meals.deleteall') }}">Delete All Selected</button>
				<a href="{{route('tables.index')}}" class="btn btn-square btn-danger mb-2"><i class="fas fa-list"></i> Tables</a>
				<a href="{{route('meals.create')}}" class="btn btn-square btn-primary mb-2"><i class="fas fa-plus"></i>  Add Meal</a>
			</div>
		</div>
		@include('backend.admin.includes.flashmessage')
	</div>
	<div class="col-md-12">
		<div class="ms-panel">
			<div class="ms-panel-header col-sm-8">
				<h6>Breakfast List</h6>
			</div>
			<div class="col-sm-2">
			</div>
			<div class="ms-panel-body">
				<div class="table-responsive">
					<table class="table table-hover thead-primary">
						<thead>
							<tr>
								<tr>
									<td width="10px">
										<input type="checkbox" id="master">
									</td>								
									<td scope="col">Food</td>
									<td scope="col">Calories</td>
									<td scope="col">Fat</td>
									<td scope="col">Action</td>
								</tr>
							</thead>
							<tbody>
								@foreach($meals as $meal)
								@if($meal->type == 'breakfast')
								<tr id="tr_{{$meal->id}}">
									<td>
										<input type="checkbox" class="sub_chk" data-id="{{$meal->id}}">
									</td>
									<td>{{$meal->food}}</td>
									<td>{{$meal->calories}}</td>
									<td>{{$meal->fat}}</td>
									<td scope="row">
										<a href='{{route('meals.edit',$meal->id)}}'>
											<i class='fas fa-pencil-alt ms-text-primary'></i>
										</a> 
										<a href='javascript:' onclick='submitform({{$loop->iteration}});'><i class='far fa-trash-alt ms-text-danger'></i>
										</a>
										<form id='delete-form{{$no}}' action='{{route('meals.destroy',$meal->id)}}' method='POST'>
											<input type='hidden' name='_token' value='{{ csrf_token()}}'>
											<input type='hidden' name='_method' value='DELETE'></form>
										</td>
									</tr>
									@endif
									@php
									$no++;
									@endphp
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-12">
				<div class="ms-panel">
					<div class="ms-panel-header">
						<h6>Snacks List</h6>
					</div>
					<div class="ms-panel-body">
						<div class="table-responsive">
							<table class="table table-hover thead-primary">
								<thead>
									<tr>
										<td width="10px">
											<input type="checkbox" id="master">
										</td>								
										<td scope="col">Food</td>
										<td scope="col">Calories</td>
										<td scope="col">Fat</td>
										<td scope="col">Action</td>
									</tr>
								</thead>
								<tbody>
									@foreach($meals as $meal)
									@if($meal->type == 'snacks')
									<tr id="tr_{{$meal->id}}">
										<td>
											<input type="checkbox" class="sub_chk" data-id="{{$meal->id}}">
										</td>

										<td>{{$meal->food}}</td>
										<td>{{$meal->calories}}</td>
										<td>{{$meal->fat}}</td>
										<td scope="row">
											<a href='{{route('meals.edit',$meal->id)}}'>
												<i class='fas fa-pencil-alt ms-text-primary'></i>
											</a> 
											<a href='javascript:' onclick='submitform({{$meal->id}});'><i class='far fa-trash-alt ms-text-danger'></i>
											</a>
											<form id='delete-form{{$meal->id}}' action='{{route('meals.destroy',$meal->id)}}' method='POST'>
												<input type='hidden' name='_token' value='{{ csrf_token()}}'>
												<input type='hidden' name='_method' value='DELETE'></form>
											</td>
										</tr>
										@endif
										@php
										$no++;
										@endphp
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-12">
					<div class="ms-panel">
						<div class="ms-panel-header">
							<h6>Lunch List</h6>
						</div>
						<div class="ms-panel-body">
							<div class="table-responsive">
								<table class="table table-hover thead-primary">
									<thead>
										<tr>

											<td width="10px">
												<input type="checkbox" id="master">
											</td>								
											<td scope="col">Food</td>
											<td scope="col">Calories</td>
											<td scope="col">Fat</td>
											<td scope="col">Action</td>
										</tr>
									</thead>
									<tbody>
										@foreach($meals as $meal)
										@if($meal->type == 'lunch')
										<tr id="tr_{{$meal->id}}">
											<td>
												<input type="checkbox" class="sub_chk" data-id="{{$meal->id}}">
											</td>

											<td>{{$meal->food}}</td>
											<td>{{$meal->calories}}</td>
											<td>{{$meal->fat}}</td>
											<td scope="row">
												<a href='{{route('meals.edit',$meal->id)}}'>
													<i class='fas fa-pencil-alt ms-text-primary'></i>
												</a> 
												<a href='javascript:' onclick='submitform({{$meal->id}});'><i class='far fa-trash-alt ms-text-danger'></i>
												</a>
												<form id='delete-form{{$meal->id}}' action='{{route('meals.destroy',$meal->id)}}' method='POST'>
													<input type='hidden' name='_token' value='{{ csrf_token()}}'>
													<input type='hidden' name='_method' value='DELETE'></form>
												</td>
											</tr>
											@endif
											@php
											$no++;
											@endphp
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<div class="ms-panel">
							<div class="ms-panel-header">
								<h6>Dinner List</h6>
							</div>
							<div class="ms-panel-body">
								<div class="table-responsive">
									<table class="table table-hover thead-primary">
										<thead>
											<tr>
												<td width="10px">
													<input type="checkbox" id="master">
												</td>								
												<td scope="col">Food</td>
												<td scope="col">Calories</td>
												<td scope="col">Fat</td>
												<td scope="col">Action</td>
											</tr>
										</thead>
										<tbody>
											@foreach($meals as $meal)
											@if($meal->type == 'dinner')
											<tr id="tr_{{$meal->id}}">
												<td>
													<input type="checkbox" class="sub_chk" data-id="{{$meal->id}}">
												</td>

												<td>{{$meal->food}}</td>
												<td>{{$meal->calories}}</td>
												<td>{{$meal->fat}}</td>
												<td scope="row">
													<a href='{{route('meals.edit',$meal->id)}}'>
														<i class='fas fa-pencil-alt ms-text-primary'></i>
													</a> 
													<a href='javascript:' onclick='submitform({{$meal->id}});'><i class='far fa-trash-alt ms-text-danger'></i>
													</a>
													<form id='delete-form{{$meal->id}}' action='{{route('meals.destroy',$meal->id)}}' method='POST'>
														<input type='hidden' name='_token' value='{{ csrf_token()}}'>
														<input type='hidden' name='_method' value='DELETE'></form>
													</td>
												</tr>
												@endif
												@php
												$no++;
												@endphp
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endsection
					@push('scripts')
					<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
					<script type="text/javascript">
						$( document ).ready(function() {
							setTimeout(function() {
								$('.alert-success').fadeOut('fast');
							}, 2200);
						});
					</script>
					<script type="text/javascript">
						function submitform(no){
							swal({
								title: "Are you sure?",
								text: "Once deleted, you will not be able to recover this Question!",
								icon: "warning",
								buttons: true,
								dangerMode: true,
							})
							.then((willDelete) => {
								if (willDelete) {
									document.getElementById('delete-form'+no).submit();
								}
							});
						}
					</script>
	<script type="text/javascript">
		$(document).ready(function () {
			$('#master').on('click', function(e) {
				if($(this).is(':checked',true))  
				{
					$(".sub_chk").prop('checked', true);  
				} else {  
					$(".sub_chk").prop('checked',false);  
				}  
			});


			$('.delete_all').on('click', function(e) {
				var allVals = [];  
				$(".sub_chk:checked").each(function() {  
					allVals.push($(this).attr('data-id'));
				});  

				if(allVals.length <=0)  
				{  
					toastr["error"]("Please Select a row");
				}  else {  

					var check = confirm("Are you sure you want to delete this row?");  
					if(check == true){  

						var join_selected_values = allVals.join(","); 

						$.ajax({
							url: "{{ route('meals.mass_destroy') }}",
							type: 'DELETE',
							headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
							data: 'ids='+join_selected_values,
							success: function (data) {
								if (data['success']) {
									$(".sub_chk:checked").each(function() {  
										$(this).parents("tr").remove();
									});
									alert(data['success']);
								} else if (data['error']) {
									alert(data['error']);
								} else {
									alert('Whoops Something went wrong!!');
								}
							},
							error: function (data) {
								alert(data.responseText);
							}
						});

						$.each(allVals, function( index, value ) {
							$('table tr').filter("[data-row-id='" + value + "']").remove();
						});
					}  
				}  
			});

			$('[data-toggle=confirmation]').confirmation({
				rootSelector: '[data-toggle=confirmation]',
				onConfirm: function (event, element) {
					element.trigger('confirm');
				}
			});


			$(document).on('confirm', function (e) {
				var ele = e.target;
				e.preventDefault();


				$.ajax({
					url: ele.href,
					type: 'DELETE',
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					success: function (data) {
						if (data['success']) {
							$("#" + data['tr']).slideUp("slow");
							alert(data['success']);
						} else if (data['error']) {
							alert(data['error']);
						} else {
							alert('Whoops Something went wrong!!');
						}
					},
					error: function (data) {
						alert(data.responseText);
					}
				});


				return false;
			});
		});
	</script>
	@endpush

