@extends('layout/home')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

<div class="card card-custom" >
										
											<div class="card-header">
												 <!--begin::Top-->
        <div class="d-flex align-items-center">
            <!--begin::Symbol-->
            <div class="symbol symbol-40 symbol-light-success mr-5">
                <span class="symbol-label">
                    <img src="/storage/{{$blog->user->profile_photo}}" class="h-75 align-self-end" alt="">
                </span>
            </div>
            <!--end::Symbol-->

            <!--begin::Info-->
            <div class="d-flex flex-column flex-grow-1">
                <a href="userprofileview/{{$blog->user->id}}" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">{{$blog->user->name }}</a>
                <span class="text-muted font-weight-bold">By {{$blog->user->name}} on {{$blog->user->created_at->format('d/m/Y')}} </span>
            </div>
            <!--end::Info-->

           
        </div>
        <!--end::Top-->
												
											</div>
											<div class="card-body ">
												  <div class="photo w-50 mx-auto">
												  <!-- <a data-fancybox='' data-caption='' href="" id="post_img">
                                                     <img src="" id="image" width="100%" height="100%" class="card-img-top rounded" alt="Error fetching image">
                                                  </a> -->
													  <img src="/storage/{{$blog->image}}" width="100%" height="100%" id="image" class="card-img-top" alt="...">	
												  </div>
											      <div class="content" id="blogContent">
											            {!! $blog->content !!}
											     </div>
												 <div class=" content tags py-0 px-5 mx-5">
													 <b>Tags:- </b> <span id="blogTag"> {{$blog->tags}}</span>    
											     </div>
												 <div class=" content tags py-0 px-5 mt-3 mx-5">
												 
												 </div>
										    </div>

							@hasanyrole('admin|user')
		                        <div class="card-footer  justify-content-between">
                                                <h5>Comments</h5>
												<form class="form"  method="POST">
  												  <input id="blog_owner_id" type="hidden" value="{{$blog->user_id}}">
                                                <div class="form-group d-flex">
                                                    <input type="text" name="comment" id="oneComment" class="form-control form-control-solid w-50"  placeholder="Add your thoughts"/>
                                                    <button type="submit" value="Add" class="btn btn-primary ml-5" id="addComment">Add </button>
                                                </div>
												</form>

												<div class="m-1" id="allComments">
											@foreach($blog->comments as $comment)
												<div class="alert bg-light-secondary border p-3">
												<h6>{{$comment->user_name}}</h6>
											    <p class="d-inline m-2">{{$comment->text}}</p>
												</div>
											@endforeach
											     </div>
												 
											</div>

                            @endhasrole 
										</div>

@endsection

@section('script')
<script src="{{asset('scripts/singleBlog.js')}}"></script>
@endsection