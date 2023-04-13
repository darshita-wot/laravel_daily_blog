@extends('layout/home')

@section('content')
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
					
					<div class="form-group row">
						<label class="col-xl-3 col-lg-3 col-form-label text-right">Set Status</label>
						<div class="col-lg-9 col-xl-6">
							<input class="form-control form-control-lg form-control-solid" name='status' type="text" value="Loop Inc.">
							<span class="form-text text-muted">If you want your invoices addressed to a company. Leave blank to use your full name.</span>
						</div>
					</div>
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
@endsection

@section('script')
    <script src="{{asset('demo8/dist/assets/js/pages/crud/file-upload/image-input.js?v=7.2.9')}}"></script>
@endsection