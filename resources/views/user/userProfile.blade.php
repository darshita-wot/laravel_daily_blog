@extends('layout/home')
@section('title')
<title>My profile</title>
@endsection
@section('content')
<div class="flex-row-fluid ml-lg-8">
<div class="card card-custom">
<div class="card-header flex-wrap border-0 pt-6 pb-0">
<ul class="nav nav-tabs nav-tabs-line">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">My Profile</a>
    </li>
   
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">Change Password</a>
    </li>
   
    <li class="nav-item">
        <a class="nav-link editBlogTab" data-toggle="tab" href="#kt_tab_pane_3">Delete Account</a>
    </li>
   
</ul>
<!-- card - header -->
</div> 
<div class="card-body">
<div class="tab-content mt-5" id="myTabContent">


    <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_2">
	<div class="content flex-column-fluid p-2" >

	<div class="card card-custom card-stretch">

<div class="card-header py-3">
	<div class="card-title align-items-start flex-column">
		<h3 class="card-label font-weight-bolder text-dark">Personal Information</h3>
		<span class="text-muted font-weight-bold font-size-sm mt-1">Update your personal informaiton</span>
	</div>
</div>
<form class="form" id="myprofile_form" enctype="multipart/form-data">
@csrf
	<!--begin::Body-->
	<div class="card-body">
		<div class="row">
			<label class="col-xl-3"></label>
			<div class="col-lg-9 col-xl-6">
				<h5 class="font-weight-bold mb-6">Customer Info</h5>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-xl-3 col-lg-3 col-form-label text-right">Avatar</label>
			<div class="col-lg-9 col-xl-6">
			<div class="image-input image-input-outline" id="kt_image_1">
			<div class="image-input-wrapper" style="background-image: url(storage/{{$user->profile_photo}})"></div>
			<!-- demo8/dist/assets/media/users/100_1.jpg -->

			<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
				<i class="fa fa-pen icon-sm text-muted"></i>
				<input type="file" name="profile_avatar" id="profile_avatar" accept=".png, .jpg, .jpeg">
				<input type="hidden" name="profile_avatar_remove">
			</label>

			<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel avatar">
				<i class="ki ki-bold-close icon-xs text-muted"></i>
			</span>
		  </div>
				<span class="form-text text-muted">Allowed file types:  png, jpg, jpeg.</span>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-xl-3 col-lg-3 col-form-label text-right">Full Name</label>
			<div class="col-lg-9 col-xl-6">
				<input class="form-control form-control-lg
				 form-control-solid" name="fullname" type="text" value="{{$user->name}}">

				 <input class="form-control form-control-lg
				 form-control-solid" name="id" type="hidden" value="{{Session('id')}}">

			</div>
		</div>
		
		<!-- <div class="form-group row">
			<label class="col-xl-3 col-lg-3 col-form-label text-right">Set Status</label>
			<div class="col-lg-9 col-xl-6">
				<input class="form-control form-control-lg form-control-solid" name='status' type="text" value="Loop Inc.">
				<span class="form-text text-muted">If you want your invoices addressed to a company. Leave blank to use your full name.</span>
			</div>
		</div> -->
		
		<div class="row">
			<label class="col-xl-3"></label>
			<div class="col-lg-9 col-xl-6">
				<h5 class="font-weight-bold mt-10 mb-6 ">Contact Info</h5>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-xl-3 col-lg-3 col-form-label text-right">Contact Phone</label>
			<div class="col-lg-9 col-xl-6">
				<div class="input-group input-group-lg input-group-solid">
					<div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
					<input type="text" name='mobileno' class="form-control form-control-lg form-control-solid" placeholder="Phone" value="{{$user->mobile_no}}">
				</div>
				<span class="form-text text-muted">We'll never share your email with anyone else.</span>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-xl-3 col-lg-3 col-form-label text-right">Email Address</label>
			<div class="col-lg-9 col-xl-6">
				<div class="input-group input-group-lg input-group-solid">
					<div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
					<input type="text" class="form-control form-control-lg form-control-solid" name="email" placeholder="Email" value="{{$user->email}}">
				</div>
			</div>
		</div>
		
		<div class="form-group row mt-10 ">
				<!-- <button id="myprofile_submit" type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2 ">Save Profile</button> -->
				<!-- <input type="submit" value="Save Profile" id="myprofile_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2"> -->
		</div>
	</div>
	<!--end::Body-->
	<div class="card-footer d-flex justify-content-center">
	<div class="card-toolbar">
		<!-- <button type="reset" class="btn btn-success mr-2" id="myprofile_submit">Save Changes</button> -->
		<input type="submit" value="Save Profile" id="myprofile_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">
		<a href="/home" class="btn btn-secondary">Cancel</a>
	</div>
</div>
</form>
</div>
</div>
</div>
</div>


<div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
	  <!--begin::Card-->
	  <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
					<h3 class="card-label font-weight-bolder text-dark">Change Password</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Change your account password</span>
                </div>
                <div class="card-toolbar">
                    <button type="reset" class="btn btn-success mr-2">Save Changes</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
            <!--end::Header-->

            <!--begin::Form-->
            <form class="form">
                <div class="card-body">
                    <!--begin::Alert-->
                    <div class="alert alert-custom alert-light-danger fade show mb-10" role="alert">
                        <div class="alert-icon">
                            <span class="svg-icon svg-icon-3x svg-icon-danger"><!--begin::Svg Icon | path:/metronic/theme/html/demo8/dist/assets/media/svg/icons/Code/Info-circle.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"></rect>
        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"></circle>
        <rect fill="#000000" x="11" y="10" width="2" height="7" rx="1"></rect>
        <rect fill="#000000" x="11" y="7" width="2" height="2" rx="1"></rect>
    </g>
</svg><!--end::Svg Icon--></span>                        </div>
                        <div class="alert-text font-weight-bold">
                            Configure user passwords to expire periodically. Users will need warning that their passwords are going to expire,<br>
                            or they might inadvertently get locked out of the system!
                        </div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="ki ki-close"></i></span>
                            </button>
                        </div>
                    </div>
                    <!--end::Alert-->
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label text-alert">Current Password</label>
                        <div class="col-lg-9 col-xl-6">
                            <input type="password" class="form-control form-control-lg form-control-solid mb-2" value="" placeholder="Current password">
                            <a href="#" class="text-sm font-weight-bold">Forgot password ?</a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label text-alert">New Password</label>
                        <div class="col-lg-9 col-xl-6">
                            <input type="password" class="form-control form-control-lg form-control-solid" value="" placeholder="New password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label text-alert">Verify Password</label>
                        <div class="col-lg-9 col-xl-6">
                            <input type="password" class="form-control form-control-lg form-control-solid" value="" placeholder="Verify password">
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
</div>
</div>
</div>
<!-- card -->
</div>
<!-- flex-row -->
</div>


@endsection

@section('script')
    <script src="{{asset('demo8/dist/assets/js/pages/crud/file-upload/image-input.js?v=7.2.9')}}"></script>
@endsection