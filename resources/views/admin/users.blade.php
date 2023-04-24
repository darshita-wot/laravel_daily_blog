@extends('layout/home')
@section('title')
<title>Users</title>
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')								
					
								<!--begin::Card-->
								<div class="card card-custom">
									<div class="card-header flex-wrap border-0 pt-6 pb-0">
										<div class="card-title">
											<h3 class="card-label">Users List
											<span class="d-block text-muted pt-2 font-size-sm">all users that have signup for daily blog</span></h3>
										</div>
										<div class="card-toolbar">
									
											<!--begin::Button-->
											<button class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#addUserModal">
											<span class="svg-icon svg-icon-md">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<circle fill="#000000" cx="9" cy="15" r="6" />
														<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
													</g>
												</svg>
												<!--end::Svg Icon-->
											</span>New User</button>
											<!--end::Button-->
										</div>
									</div>
									<div class="card-body">
										<!--begin: Search Form-->
										<!--begin::Search Form-->
										<div class="mb-7">
											<div class="row align-items-center">
												<div class="col-lg-9 col-xl-8">
													<div class="row align-items-center">
														<div class="col-md-4 my-2 my-md-0">
															<div class="input-icon">
																<input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
																<span>
																	<i class="flaticon2-search-1 text-muted"></i>
																</span>
															</div>
														</div>
														<div class="col-md-4 my-2 my-md-0">
															<div class="d-flex align-items-center">
															<button class="btn btn-success mr-5" id="clear_user">Clear </button>
															<!-- <label class="mr-3 mb-0 d-none d-md-block">Status:</label> -->
															<!-- <select class="form-control" id="kt_datatable_search_status">
																<option value="">All</option>
																<option value="1">Active</option>
																<option value="2">InActive</option>
																
															</select> -->
														</div>
													</div>
														
													</div>
												</div>
												
											</div>
										</div>
										<!--end::Search Form-->
										<!--end: Search Form-->
										<!--begin: Datatable-->
										<div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
										<!--end: Datatable-->
									</div>
								</div>
								<!--end::Card-->
						
<!-- Modal for adding customer-->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customerModalLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
               <form id="addUser" method="post">
                @csrf
                <!-- start: card body -->
                 <div class="card-body modal-default p-4">
                 <div class="form-group row">
				<label for="fullname"  class="col-3 col-form-label">Full Name : </label>
				<div class="col-9">
					<input class="form-control " type="text" placeholder="Full Name" name="fullname" />
									<span class="text-danger" id="fullname_error"></span>
				</div>
			     </div>
                 <div class="form-group row">
				<label for="email" class="col-3 col-form-label">Email :</label>
				<div class="col-9">
					<input class="form-control" type="email"  id="email" name="email" placeholder="email"/>
                    <span class="text-danger error" id="email_error"></span>
				</div>
			    </div>
				<div class="form-group row">
				<label for="fullname"  class="col-3 col-form-label">Password : </label>
				<div class="col-9">
				<input class="form-control " type="password" placeholder="Password" name="password" />
					<span class="text-danger" id="password_error"></span>
				</div>
			     </div>
                <div class="form-group row">
				<label for="mobile_no" class="col-3 col-form-label">Mobile No : </label>
				<div class="col-9">
					<input class="form-control" id="kt_inputmask_5" type="text" im-insert="true" name="mobile_no" placeholder="Mobile No"/>
                    <span class="text-danger error" id="mobileno_error"></span>
				</div>
			    </div>

				<div class="form-group row">
				<label for="birthday_date"  class="col-3 col-form-label">Birthday Date : </label>
				<div class="col-9">
				<input type="text" class="form-control " name="birthday_date" placeholder="Select date" id="kt_datepicker">
				<span class="text-danger" id="birthdaydate_error"></span>
				</div>
			    </div>

            <!-- end: card body -->
                </div>
               </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold closeAddModal" data-dismiss="modal">Close</button>
                <button type="submit" id="saveUser" class="btn btn-primary font-weight-bold">Add User</button>
            </div>
        </div>
    </div>
</div>
	
<!-- Modal for updating customer-->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customerModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
               <form id="updateUser" method="post">
                @csrf
                <!-- start: card body -->
                 <div class="card-body modal-default p-4">
                 <div class="form-group row">
				<label for="fullname"  class="col-3 col-form-label">Full Name : </label>
				<div class="col-9">
					<input class="form-control " type="text" placeholder="Full Name" id="fullname" name="fullname" />
									<span class="text-danger" id="edit_fullname_error"></span>
				</div>
			     </div>
                 <div class="form-group row">
				<label for="email" class="col-3 col-form-label">Email :</label>
				<div class="col-9">
					<input class="form-control" type="email"  id="email" name="email" placeholder="email"/>
                    <span class="text-danger error" id="edit_email_error"></span>
				</div>
			    </div>
				<div class="form-group row">
				<label for="fullname"  class="col-3 col-form-label">Password : </label>
				<div class="col-9">
				<input class="form-control " type="password" placeholder="Password" name="password" id="password"/>
					<span class="text-danger" id="edit_password_error"></span>
				</div>
			     </div>
                <div class="form-group row">
				<label for="mobile_no" class="col-3 col-form-label">Mobile No : </label>
				<div class="col-9">
					<input class="form-control" id="kt_inputmask_5" type="text" im-insert="true" name="mobile_no" placeholder="Mobile No"/>
                    <span class="text-danger error" id="edit_mobileno_error"></span>
				</div>
			    </div>

				<div class="form-group row">
				<label for="birthday_date"  class="col-3 col-form-label">Birthday Date : </label>
				<div class="col-9">
				<input type="text" class="form-control " name="birthday_date" placeholder="Select date" id="kt_datepicker">
				<span class="text-danger" id="edit_birthdaydate_error"></span>
				</div>
			    </div>

            <!-- end: card body -->
                </div>
               </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold closeEditModal" data-dismiss="modal">Close</button>
                <button type="submit" id="updateUserBtn" class="btn btn-primary font-weight-bold">Update User</button>
            </div>
        </div>
    </div>
</div>

		
@endsection	
		
@section('script')
 <!--begin::Page Script Customer DATATABLE-->
 <!--input mask js-->
 <script src="{{('demo8/dist/assets/js/pages/crud/forms/widgets/input-mask.js?v=7.0.3')}}"></script>
 <!-- for date -->
 <script src="{{('demo8/dist/assets/js/pages/crud/forms/validation/form-widgets.js?v=7.0.3')}}"></script>
 <script  src="{{asset('scripts/users_datatable_ajax.js')}}"></script>
@endsection