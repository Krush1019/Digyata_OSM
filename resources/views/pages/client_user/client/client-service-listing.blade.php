@extends('layouts.client_user.client-contentLayoutMaster')

@section('title','Service Listing')

@section('custom-style')
	<link href="{{asset('client_user/client/css/custom.css')}}" rel="stylesheet">
@endsection

@section('content')
	<div class="box_general">
		<div class="header_box">
			<a class="font-large-20 btn btn-success mr-3" href="{{route('add-service-listing',"insert")}}"><i class="fa fa-plus"></i></a>
			<h2 class="d-inline-block ">Service Listings</h2>
			<div class="filter">
				<select name="orderby" class="selectbox">
					<option value="All">All</option>
					<option value="Panding">Panding</option>
					<option value="Active">Active</option>
					<option value="Reject">Reject</option>
				</select>
			</div>
		</div>

		<div class="list_general">
			<ul>
				@foreach ($serviceList as $value)
					<li>
						<figure><img src="{{asset($value['img'])}}" alt="Service Image"></figure>
						<small>{{$value['service_cat']}}</small>
						<h4>{{$value['name']}}</h4>
						<div class="service_description">{!!$value['dec']!!} </div>
						<p>
							<button type="button" class="btn_1 gray modal_btn" data-id="{{$value['main_id']}}">
								<i class="fa fa-fw fa-eye"></i> View Service
							</button>
							{{-- <button type="button" class="btn_1 gray modal_btn" data-toggle="modal" data-target="#viewServiceModal" data-id="{{$value['main_id']}}">
								<i class="fa fa-fw fa-eye"></i> View Service
							</button> --}}
						</p>
						<ul class="buttons">
							<li class="">
								@if($value['status'] == 1)
									<a href="#" class="btn_1 gray s_status approve" data-id="{{$value['main_id']}}"><i
												  class="fa fa-fw fa-check"></i> Active</a>
								@else
									<a href="#" class="btn_1 gray s_status delete" data-id="{{$value['main_id']}}"><i class="fa fa-fw fa-ban mr-1"></i> Inactive</a>
								@endif
							</li>
						</ul>
					</li>

				@endforeach

			</ul>
		</div>
	</div>
	<!-- /box_general-->


	<nav aria-label="...">
		<ul class="pagination pagination-sm add_bottom_30">
			<li class="page-item disabled">
				<a class="page-link" href="#" tabindex="-1">Previous</a>
			</li>
			<li class="page-item"><a class="page-link" href="#">1</a></li>
			<li class="page-item"><a class="page-link" href="#">2</a></li>
			<li class="page-item"><a class="page-link" href="#">3</a></li>
			<li class="page-item">
				<a class="page-link" href="#">Next</a>
			</li>
		</ul>
	</nav>
	<!-- /pagination-->

	{{-- START: View Modal --}}
	<div class="modal fade" id="viewServiceModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
			<div class="modal-content">

				<div class="modal-header">
					<h4 class="modal-title">View Service</h4>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>

				<div class="modal-body container-fluid">
					<div class="row">

						<div class="box_general m-4 w-100 pb-4 viewservicespan">
							<div class="header_box version_2">
								<h2><i class="fa fa-file text-pink"></i>Service info</h2>
							</div>
							<div class="row">
								<div class="col-md-3">
									<img src="{{ asset('images/client/ser_img/1729262673-1614601090.jpg') }}"
									     class="img-thumbnail service_img" alt="Cinque Terre">
								</div>
								<div class="col-md-4">
									<div class="mt-20">
										<div class="col-sm-12 small pl-0">Provider Name :</div>
										<div class="col-sm-12 font-large-17 font-weight-bold pl-0 provider_name">Jay Goga</div>
									</div>

									<div class="mt-15">
										<div class="col-sm-12 small pl-0">Expericence :</div>
										<div class="col-sm-12 font-large-17 font-weight-bold pl-0 provider_exp">2 Year</div>
									</div>

								</div>
								<div class="col-md-5">
									<div class="mt-20">
										<div class="col-sm-12 small pl-0">Service :</div>
										<div class="col-sm-12 font-large-17 font-weight-bold pl-0 service_name">House Wasing</div>
									</div>

									<div class="mt-10">
										<div class="col-sm-12 small pl-0">Category :</div>
										<div class="col-sm-12 font-large-17 font-weight-bold pl-0 service_cate">Cleaning</div>
									</div>
								</div>

							</div>

							<div class="row">

								<div class="col-md-5 mt-20">
									<div class="">
										<div class="user-info">
											<div>
												<span class="col-sm-12 small pl-0">Phone : </span>
												<span class="col-sm-12 font-weight-bold pl-0 ser_phone">8200707338</span>
											</div>
											<div>
												<span class="col-sm-12 small pl-0">E-mail : </span>
												<span class="col-sm-12 font-weight-bold pl-0"><a
															  href="mailto:meetprajapati847@gmail.com" class="ser_email"
															  target="_blank">meetprajapati847@gmail.com</a></span>
											</div>
										</div>
									</div>
									<div class="mt-15">
										<div class="col-sm-12 small pl-0">Social Media :</div>
										<div class="social mt-15">
											{{-- <a href="google.com"  target="_blank" class='social-icon globe'>
												<i class="fa fa-globe fa-2x"></i>
											</a> --}}
											{{-- <a href='google.com'  target='_blank' class='social-icon facebook'>
												<i class='fa fa-facebook-f fa-2x'></i>
											</a> --}}
											{{-- <a href="google.com"  target="_blank" class='social-icon twitter'>
												<i class='fa fa-twitter fa-2x'></i>
											</a> --}}
											{{-- <a href="google.com"  target="_blank" class='social-icon instagram'>
												<i class='fa fa-instagram fa-2x'></i>
											</a> --}}
											{{-- <a href="google.com"  target="_blank" class='social-icon linkedin'>
												<i class="fa fa-linkedin fa-2x"></i>
											</a> --}}
										</div>

									</div>
								</div>
								<div class="col-md-7">
									<div class="mt-20">
										<div class="col-sm-12 small pl-0">Description :</div>
										<div class="col-sm-12 pl-0 ser_des"></div>
									</div>
								</div>
							</div>

							<div class="header_box version_2 mt-4">
								<h2><i class="fa fa-paperclip"></i>Document</h2>
							</div>

							<div class="row">
								<div class="col-md-6">
									<span class="mb-10">
										<a href="#" type="button" target="_blank" class="btn_1 gray view_doc">
											<i class="fa fa-file"></i>&nbsp;View Document
										</a>
									</span>
								</div>
								<div class="col-md-6">
									<span>Aadhar No.: </span>
									<span class="doc_num">788565231578</span>
								</div>
							</div>

							<div class="header_box version_2 mt-4">
								<h2><i class="fa fa-map-marker"></i>Location</h2>
							</div>

							<div class="row">
								<div class="col-md-6">
									<span>
										<label>City: </label><label>Mahesana</label>
									</span>
								</div>
								<div class="col-md-6">
									<span>
										<label>State: </label><label>Gujarat</label>
									</span>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<span>
										<label>Address: </label>
										<label>20, Madhuvan Complex, Radhanpur Cross road, Mahesana-2</label>
									</span>
								</div>
								<div class="col-md-6">
									<span><label>Pincode: </label><label>698745</label></span>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4 col-lg-4 col-sm-12">
									<div class="header_box version_2 mt-4">
										<h2><i class="fa fa-clock-o"></i>Availability</h2>
									</div>

									<div class="table-responsive-sm ">
										<table class="table table-borderless day_time">
											<caption>List of Working Days in Week</caption>
											<thead>
											<tr>
												<th scope="col">Days</th>
												<th scope="col">Time</th>
											</tr>
											</thead>
											<tbody>
											{{-- Code Here --}}
											</tbody>
										</table>
									</div>
								</div>
								<div class="col-md-1 col-lg-1"></div>
								<div class="col-md-7 col-lg-7 col-sm-12">
									<div class="header_box version_2 mt-4">
										<h2><i class="fa fa-dollar"></i>Pricing</h2>
									</div>

									<div class="table-responsive-sm ">
										<table class="table table-borderless list_item">
											<caption>List of Item</caption>
											<thead>
											<tr class="d-flex">
												<th class="col-md-3">Item</th>
												<th class="col-md-2">Price</th>
												<th class="col-md-7">Description</th>
											</tr>
											</thead>
											<tbody>
											{{-- Code Here  --}}
											</tbody>
										</table>
									</div>
								</div>
							</div>

						</div>
					</div>

					<div class="modal-footer">
						<a class="btn btn-primary edit_btn" href="{{route('add-service-listing',"0")}}">Edit Service</a>
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					</div>

				</div>
			</div>
		</div>
	</div>
	{{-- END: View Modal --}}
@endsection

@section('page-script')
	<script src="{{asset('client_user/client/js/page-scripts/client-service-listing.js')}}"></script>
	<script src="{{ asset('js/scripts/extensions/sweetalert2.js')}}"></script>
@endsection
