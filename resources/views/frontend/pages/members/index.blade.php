@extends('master')
@section('body')
<div class="content-wrapper">
	<div class="page-title">
		<div>
			<h1>Members</h1>
			{{-- <ul class="breadcrumb side">
				<li><i class="fa fa-home fa-lg"></i></li>
				<li>Tables</li>
				<li class="active"><a href="#">Data Table</a></li>
			</ul> --}}
		</div>
		<div>
			<a href="{{ route('members.create') }}" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#myModal"><i class="fa fa-lg fa-plus"></i></a>
			<a href="{{ route('members.index') }}" class="btn btn-info btn-flat"><i class="fa fa-lg fa-refresh"></i></a>
			<a href="#" class="btn btn-warning btn-flat"><i class="fa fa-lg fa-trash"></i></a></div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">

						<!-- <div class="clusterize">
							<table>
								<thead>
									<tr class="replace-inputs">
										<th class="text-center">#</th>
										<th class="text-center">Name and Role</th>
										<th class="text-center">E-Mail</th>
										<th class="text-center">Phone</th>
										<th class="text-center">Actions</th>
									</tr>
								</thead>
							</table>
							<div id="scrollArea" class="clusterize-scroll">
								<table>
									<tbody id="contentArea" class="clusterize-content">
										<tr class="clusterize-no-data">
											<td>Loading data…</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div> -->

						<div class="table-responsive">
							<table class="table table-striped table-bordered dynatable" cellspacing="0" width="100%">
								<thead>
									<tr class="">
										<th class="text-center">#</th>
										<th class="text-center">Name and Role</th>
										@level(7)
										<th class="text-center">Church</th>
										@endlevel
										<th class="text-center">E-Mail</th>
										<th class="text-center">Phone</th>
										<th class="text-center">Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach($members as $member)
									<tr id="tr_{{$member->id}}">
										<td class="text-center">
											{{ $loop->iteration }}
										</td>
										<td class="user-name">
											<a href="{{ route('members.show', array($member->id)) }}" class="name">{{$member->fname. ' '. $member->lname}}</a>
										</td>
										@level(7)
											<td class="">
											@if($member->church)
											{{$member->church->name}}
											@endif
										</td>
										@endlevel
										<td class="">
											<span class="email">{{$member->email}}</span>
										</td>
										<td class="user-id">
											{{$member->phone}}
										</td>
										<td class="action-links">
											<div class="row">
												<div class="col-xs-12">
													<a href="{{ route('members.show', array($member->id)) }}" class=""  style="font-size:11px; color: #B4D883">
														View Profile
													</a>
													<br>
													<a href="{{ route('members.delete', $member->id) }}" class="delete" style="font-size:11px; color: #E8B7B9" id="{{ $member->id }}"
														data-tr="tr_{{$member->id}}"
														data-toggle="confirmation"
														data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
														data-btn-ok-class="btn btn-sm btn-danger"
														data-btn-cancel-label="Cancel"
														data-btn-cancel-icon="fa fa-chevron-circle-left"
														data-btn-cancel-class="btn btn-sm btn-default"
														data-title="Are you sure you want to delete ?"
														data-placement="left" data-singleton="true">
														Delete
													</a>
												</div>
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@stop

	@section('page_css')
	@stop


	@section('page_js')
	<script type="text/javascript">

		
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



			// clusterize Js
			var data = [];
			var members = {!! json_encode($members) !!}
			jQuery.each(members, function(index, value){
				data.push('	<tr>\
					<td class="text-center">'+(index + 1)+'</td>\
					<td>'+value.fname+' '+value.lname+'</td>\
					<td>'+value.email+'</td>\
					<td>'+value.phone+'</td>\
					<td class="action-links">\
						<div class="row">\
							<div class="col-xs-12">\
								<a href="{{ route("members.show", '+value.id+') }}" \
								class=""  style="font-size:11px; color: #B4D883">\
								View Profile\
							</a>\
							<br>\
							<a href="{{ route('members.delete', '+value.id+') }}" \
							class="delete" style="font-size:11px; color: #E8B7B9" id="'+value.id+'">\
							Delete\
						</a>\
					</div>\
				</div>\
			</td>\
		</tr>');
			});

			var clusterize = new Clusterize({
				rows: data,
				scrollId: 'scrollArea',
				contentId: 'contentArea'
			});

			$(document).ready(function() {

			// delete member
			$('.deleteMember').click(function(){

				var id = this.id;

				swal({
					title: "Delete?",
					text: "Submit to run ajax request",
					type: "info",
					showCancelButton: true,
					closeOnConfirm: false,
					showLoaderOnConfirm: true,
				},
				function(){

					var url = "members/" + id + "/delete";

					$.ajax({
						url: url,
						type: 'GET',
						datatype: 'JSON',
						success: function (resp) {
							setTimeout(function(){
								swal(resp.message);
							}, 2000);
						}
					});
				});
			});
		});

		</script>
		@stop
