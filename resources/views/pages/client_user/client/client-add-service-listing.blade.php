@extends('layouts.client_user.client-contentLayoutMaster')

@section('title','Add Service Listing')

@section('page-style')
	<link href="{{asset('client_user/client/css/dropzone.css')}}" rel="stylesheet">
	<link href="{{asset('client_user/client/css/fullcalendar.css')}}" rel="stylesheet">
	<link href="{{asset('client_user/client/css/fullcalendar.print.css')}}" rel="stylesheet" media="print">
@endsection

@section('custom-style')
	<link href="{{asset('client_user/client/css/custom.css')}}" rel="stylesheet">
	<link href="{{asset('client_user/client/css/summernote-bs4.css')}}" rel="stylesheet">
@endsection

@section('content')
	<form method="POST" id="addServiceListForm" enctype="multipart/form-data">
		@csrf
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-file"></i>Service info</h2>
			</div>
			<input type="text" value="1" id="user_id" name="user_id" hidden>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="SL_ser_name">Service Name </label>
						<select id="SL_ser_name" name="SL_ser_name" class="form-control styled-select">
							@if ($serviceList == null)
								<option value="-1" disabled selected>No Data Found</option>
							@else
								<option value="-1" disabled selected>Select</option>
								{{-- Print Service Name --}}
								@foreach ($serviceList as $row)
									<option value="{{$row->serviceName}}" data-category="{{$row->serviceCategory}}"
									        data-id="{{$row->id}}"
									        @isset($serviceData) @if($serviceData['service_name'] == $row->serviceName) selected @endif @endisset >{{$row->serviceName}}</option>
								@endforeach
							@endif

						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="SL_ser_category">Category</label>
						<input type="text" class="form-control" name="SL_ser_category"
						       value="@isset($serviceData){{$serviceData['service_cat']}}@endisset" id="SL_ser_category"
						       placeholder="Category" disabled>
					</div>
				</div>
			</div>
			<!-- /row-->

			<div class="row">

				<div class="col-md-6">
					<div class="form-group">
						<label for="SL_Ser_shopname">Shop Name / Provider Name</label>
						<input type="text" class="form-control" name="SL_Ser_shopname" id="SL_Ser_shopname"
						       value="@isset($serviceData){{$serviceData['name']}}@endisset"
						       placeholder="Shop Name / Provide Name">
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="SL_Ser_experience">Expericence in related Field (In Months/Years)</label>
						<input type="text" class="form-control" name="SL_Ser_experience" id="SL_Ser_experience"
						       value="@isset($serviceData){{$serviceData['exp']}}@endisset" placeholder="2 Months / 2 Years">
					</div>
				</div>
			</div>
			<!-- /row-->

			<div class="row">
				<div class="col-md-12">
					@if(@isset($serviceData))
						<input type="text" id="ser_des" value="{{$serviceData['dec']}}" hidden>
					@endif
					<div class="form-group">
						<label for="SL_ser_description">Description</label>
						<div class="editor"></div>
					</div>
				</div>
			</div>
			<!-- /row-->

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="SL_ser_phone"><i class="fa fa-fw fa-phone"></i> Phone (Optional)</label>
						<input type="text" class="form-control" name="SL_ser_phone" id="SL_ser_phone"
						       value="@isset($serviceData){{$serviceData['phone']}}@endisset">
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="SL_ser_website"><i class="fa fa-fw fa-link"></i> Web site (Optional)</label>
						<input type="text" class="form-control" name="SL_ser_website" id="SL_ser_website"
						       value="@isset($serviceData){{$serviceData['web']}}@endisset">
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="SL_ser_email"><i class="fa fa-fw fa-envelope"></i> Email (Optional)</label>
						<input type="text" class="form-control" name="SL_ser_email" id="SL_ser_email"
						       value="@isset($serviceData){{$serviceData['email']}}@endisset">
					</div>
				</div>

			</div>
			<!-- /row-->

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="SL_ser_fblink"><i class="fa fa-fw fa-facebook"></i> Facebook link (Optional)</label>
						<input type="text" class="form-control" name="SL_ser_fblink" id="SL_ser_fblink"
						       value="@isset($serviceData){{$serviceData['fb']}}@endisset">
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="SL_ser_twlink"><i class="fa fa-fw fa-twitter"></i> Twitter link (Optional)</label>
						<input type="text" class="form-control" name="SL_ser_twlink" id="SL_ser_twlink"
						       value="@isset($serviceData){{$serviceData['tw']}}@endisset">
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="SL_ser_ldlink"><i class="fa fa-fw fa-linkedin"></i> Linkedin + (Optional)</label>
						<input type="text" class="form-control" name="SL_ser_ldlink" id="SL_ser_ldlink"
						       value="@isset($serviceData){{$serviceData['linkedin']}}@endisset">
					</div>
				</div>

			</div>
			<!-- /row-->

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="SL_ser_photos">Photos</label>
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="SL_ser_photos" name="SL_ser_photos">
							<label class="custom-file-label" for="SL_ser_photos">Choose file</label>
							@if(@isset($serviceData))
								<input type="text" name="ser_img_file" value="{{$serviceData['img']}}" hidden>
							@endif

						</div>
					</div>
				</div>
			</div>
			<!-- /row-->

		</div>

		<!-- /box_general-->
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-map-marker"></i>Document</h2>
			</div>

			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label for="SL_ser_idproof">Upload Id Proof</label>
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="SL_ser_idproof">
							<label class="custom-file-label" id="a1" for="SL_ser_idproof">Choose file</label>
							@if(@isset($serviceData))
								<input type="text" name="ser_doc_file" value="{{$serviceData['doc_img']}}" id="SL_ser_idproof"
								       hidden>
							@endif
							<label class="small font-weight-bold text-secondary">You can upload Aadhar Card/ Pan card/ Driving
								Licence as Id Proof.</label>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="SL_Ser_aadharNo">Aadhar No.</label>
						<input type="text" class="form-control" name="SL_Ser_aadharNo" id="SL_Ser_aadharNo"
						       value="@isset($serviceData){{$serviceData['doc_num']}}@endisset" placeholder="Aadhar No.">
					</div>
				</div>

			</div>
		</div>
		<!-- /box_general-->

		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-map-marker"></i>Location</h2>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="SL_ser_city">Select City</label>
						<select name="SL_ser_city" id="SL_ser_city" class="form-control styled-select">
							<option value="-1" selected disabled>Select</option>
							<option value="Miami">Miami</option>
							<option value="New York">New York</option>
							<option value="Los Angeles">Los Angeles</option>
							<option value="San Francisco">San Francisco</option>
						</select>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="SL_ser_state">State</label>
						<select class="form-control styled-select" name="SL_ser_state" id="SL_ser_state"></select>
					</div>
				</div>
			</div>

			<!-- /row-->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="SL_ser_address">Address</label>
						<input type="text" class="form-control" placeholder="ex. 250, Fifth Avenue..." name="SL_ser_address"
						       id="SL_ser_address">
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="SL_ser_pincode">Pin Code</label>
						<input type="text" class="form-control" name="SL_ser_pincode" id="SL_ser_pincode">
					</div>
				</div>
			</div>
			<!-- /row-->
		</div>

		<!-- /box_general-->
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-clock-o"></i>Availability</h2>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class=" form-group">
						<div>
						<span class="mr-3 ">
							<label for="days" class="mr-3">Working days in Week:</label>
						</span>
						</div>
						<div class="row">
							<span class="mr-2 col-md-1 col-sm-12">
								<input type="radio" name="days" value="ALL" required>
								<label> All</label>
							</span>
							<span class="mr-2 col-md-2 col-sm-12">
								<input type="radio" name="days" value="6D" checked>
								<label> 6 Days (Mon-Sat)</label>
							</span>
							<span class="mr-2 col-md-2 col-sm-12">
								<input type="radio" name="days" value="5D">
								<label> 5 Days (Mon-Fri)</label>
							</span>
							<span class="mr-2 col-md-2 col-sm-12">
								<input type="radio" name="days" value="CUSTOM">
								<label> Custom</label>
							</span>
						</div>
						@if(@isset($serviceData))
							<input type="text" id="days" value="{{$serviceData['days']}}" hidden>
							<input type="text" id="days_time" value="{{$serviceData['days_time']}}" hidden>
						@endif
					</div>
				</div>

				<div id="def_days" class="col-md-12">
					<div class="row">
						<div class="col-md-2">
							<label class="fix_spacing" id="days_name">Mon - Sat</label>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<select class="form-control styled-select styled-select-value optime" name="opening_time"
								        id="start_time"></select>
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<select class="form-control styled-select styled-select-value cltime" name="closing_time"
								        id="end_time"></select>
							</div>
						</div>
					</div>
				</div>

				<div id="add-day-div" class="col-md-12" hidden="hidden">
					<div class="row add-day-data">
						<div class="col-md-2">
							<label class="fix_spacing">Monday</label>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<select class="form-control styled-select styled-select-value start_time"
								        name="opening_time"></select>
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<select class="form-control styled-select styled-select-value end_time"
								        name="closing_time"></select>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /box_general-->

		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-dollar"></i>Pricing</h2>
			</div>

			<div class="row">
				<div class="col-md-12">
					<h6>Item</h6>
					<table id="pricing-list-container" class="w-100">
						@isset($serviceData)
							@foreach ($serviceData['item'] as $item )
								<tr class="pricing-list-item">
									<td>
										<div class="row ">
											<div class="col-md-3">
												<div class="form-group">
													<input type="text" class="form-control" value="{{ $item['iName']}}"
													       placeholder="Title" name="pli_name">
												</div>
											</div>
											<div class="col-md-5">
												<div class="form-group">
													<input type="text" class="form-control" value="{{ $item['iDes']}}"
													       placeholder="Description" name="pli_desc">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group input-group">
													<div class="input-group-prepend">
														<span class="input-group-text" id="price_icon"><small>₹</small></span>
													</div>
													<input type="text" id="item_price" name="pli_price" class="form-control"
													       value="{{ $item['iPrice']}}" placeholder="Price"
													       aria-describedby="price_icon">
												</div>
											</div>
											<div class="col-md-1 ">
												<div class="form-group pt-2">
													<a class="delete" href="#"><i class="fa fa-fw fa-remove"></i></a>
												</div>
											</div>
										</div>
									</td>
								</tr>
							@endforeach
						@endisset
						<tr class="pricing-list-item">
							<td>
								<div class="row ">
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Title" name="pli_name">
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Description" name="pli_desc">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="price_icon"><small>₹</small></span>
											</div>
											<input type="text" id="item_price" name="pli_price" class="form-control"
											       placeholder="Price" aria-describedby="price_icon">
										</div>
									</div>
									<div class="col-md-1 ">
										<div class="form-group pt-2">
											<a class="delete" href="#"><i class="fa fa-fw fa-remove"></i></a>
										</div>
									</div>
								</div>
							</td>
						</tr>
					</table>
					<button type="button" class="btn_1 gray add-pricing-list-item"><i
										class="fa fa-fw fa-plus-circle mr-1"></i>Add Item
					</button>
				</div>
			</div>
			<!-- /row-->
		</div>
		<!-- /box_general-->
		<p><input type="button" class="btn_1 medium" id="addServiceListbtn" value="Save"
		          data-action="@if (@isset($serviceData)) update @else insert @endif"
		          data-id="@if (@isset($serviceData)) {{$serviceData['main_id']}} @endif"></p>
	</form>


	<div class="card">
		<div id="cus_id" class="header">

		</div>
	</div>

@endsection

@section('page-script')
	<script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
@endsection

@section('custom-script')
	<script src="{{asset('client_user/client/js/dropzone.min.js')}}"></script>
	<script src="{{asset('client_user/client/js/summernote-bs4.min.js')}}"></script>
	<script>
      $('.editor').summernote({
          fontSizes: ['10', '14'],
          toolbar: [
              // [groupName, [list of button]]
              ['style', ['bold', 'italic', 'underline', 'clear']],
              ['font', ['strikethrough']],
              ['fontsize', ['fontsize']],
              ['para', ['ul', 'ol', 'paragraph']]
          ],
          placeholder: 'Write here ....',
          tabsize: 2,
          height: 200
      });
	</script>

	<!-- SPECIFIC CALENDAR -->
	<script src="{{asset('client_user/client/js/moment.min.js')}}"></script>
	<script src="{{asset('client_user/client/js/jquery-ui.custom.min.js')}}"></script>
	<script src="{{asset('client_user/client/js/fullcalendar.min.js')}}"></script>
	<script src="{{asset('client_user/client/js/fullcalendar_func.js')}}"></script>
	<script src="{{asset('client_user/client/js/page-scripts/client-add-service-listing.js')}}"></script>
	<script src="{{asset('client_user/client/js/sweetalert2.min.js')}}"></script>
@endsection
