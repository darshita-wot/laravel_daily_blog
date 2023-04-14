@extends('layout/home')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<!--begin::Card-->
<div class="card card-custom">
									<div class="card-header flex-wrap border-0 pt-6 pb-0">
										<div class="card-title">
											<h3 class="card-label">Approve Comments
										</div>
										
									</div>
									<div class="card-body">
										
										<!--begin: Datatable-->
										<div class="datatable datatable-bordered datatable-head-custom" id="kt_comments_datatable"></div>
										<!--end: Datatable-->
									</div>
								</div>
								<!--end::Card-->
@endsection

@section('script')
<script src="{{asset('scripts/singleBlog.js')}}"></script>
@endsection