@extends('layout/home')
@section('title')
<title>Tags</title>
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<!--begin::Card-->
<div class="card card-custom">
									<div class="card-header flex-wrap border-0 pt-6 pb-0">
										<div class="card-title">
											<h3 class="card-label">Tags Available For Blogs
										</div>
										<div class="card-toolbar">
											
											<!--begin::Button-->
											<button class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#addTagModal">
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
											</span>New Tag</button>
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
																<input type="text" class="form-control" placeholder="Search..." id="kt_tag_datatable_search_query" />
																<span>
																	<i class="flaticon2-search-1 text-muted"></i>
																</span>
															</div>
														</div>
														<!-- <div class="col-md-4 my-2 my-md-0">
															<div class="d-flex align-items-center">
																<label class="mr-3 mb-0 d-none d-md-block">Status:</label>
																<select class="form-control" id="kt_datatable_search_status">
																	<option value="">All</option>
																	<option value="1">Active</option>
																	<option value="2">InActive</option>
																	
																</select>
															</div>
														</div> -->
														
													</div>
												</div>
												
											</div>
										</div>
										<!--end::Search Form-->
										<!--end: Search Form-->
										<!--begin: Datatable-->
										<div class="datatable datatable-bordered datatable-head-custom" id="kt_tags_datatable"></div>
										<!--end: Datatable-->
									</div>
								</div>
								<!--end::Card-->

<!-- Modal for adding Tag-->
<div class="modal fade" id="addTagModal" tabindex="-1" role="dialog" aria-labelledby="tagModalLabel" aria-hidden="true">
    <div class="modal-dialog-centered modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TagModalLabel">Add Tag</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
               <form id="addTag" method="post">
                @csrf
                 <!-- start: card body -->
                 <div class="card-body modal-default p-4">
                 <div class="form-group row">
				<label for="tagname"  class="col-3 col-form-label">Tag Name : </label>
				<div class="col-9">
					<input class="form-control " type="text" placeholder="Tag Name" name="tagname" />
									<span class="text-danger" id="tagname_error"></span>
				</div>
			    </div>
             <!-- end: card body -->
             </div>
               </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold closeTagModal" data-dismiss="modal">Close</button>
                <button type="submit" id="saveTag" class="btn btn-primary font-weight-bold">Add Tag</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal for updating Tag-->
<div class="modal fade" id="updateTagModal" tabindex="-1" role="dialog" aria-labelledby="tagModalLabel" aria-hidden="true">
    <div class="modal-dialog-centered modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TagModalLabel">Update Tag</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
               <form id="updateTag">
                @csrf
                 <!-- start: card body -->
                 <div class="card-body modal-default p-4">
                 <div class="form-group row">
				<label for="tagname"  class="col-3 col-form-label">Tag Name : </label>
				<div class="col-9">
					<input class="form-control " type="text" placeholder="Tag Name" name="tagname" id="tagname"/>
                    <input type="hidden" id="tag_id" >
									<span class="text-danger" id="edit_tagname_error"></span>
				</div>
			    </div>
             <!-- end: card body -->
             </div>
               </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold closeUpdateTagModal" data-dismiss="modal">Close</button>
                <button type="submit" id="updateTagBtn" class="btn btn-primary font-weight-bold">Update Tag</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
 <script  src="{{asset('scripts/tags_datatable.js')}}"></script>
@endsection