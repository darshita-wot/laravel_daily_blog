@extends('layout/home')
@section('title')
<title>{{ $blog->title }}</title>
@endsection
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
            <!-- href="userprofileview/{{$blog->user->id}}" -->
                <a  class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">{{$blog->user->name }}</a>
                <span class="text-muted font-weight-bold">By {{$blog->user->name}} on {{$blog->user->created_at->format('d/m/Y')}} </span>
            </div>
            <!--end::Info-->

           
        </div>
        <!--end::Top-->
												
											</div>
											<div class="card-body ">
                                                <h2 class="content">{{$blog->title}}</h2>
												  <div class="photo w-50 mx-auto">
												  <!-- <a data-fancybox='' data-caption='' href="" id="post_img">
                                                     <img src="" id="image" width="100%" height="100%" class="card-img-top rounded" alt="Error fetching image">
                                                  </a> -->
													  <img src="/storage/{{$blog->image}}" width="100%" height="100%" id="image" class="card-img-top" alt="...">	
												  </div>
											      <div class="content" id="blogContent">
											            {!! $blog->content !!}
											     </div>
												 <div class=" content tags py-0 mb-3 px-5 mx-5">
												 <span class="text-dark font-size-lg font-weight-bolder">Tags:- </span> <span id="blogTag"> {{$blog->tags}}</span>    
											     </div>
												 <span class="text-dark content py-0 mb-3 px-5 mx-5 font-size-lg font-weight-bolder pb-3">
                    Blog Rating
                </span>
												 <div class="content tags py-0 px-5 mx-5 d-flex" id="blog_rating">
           
            @for ($i = 1 ; $i <= floor($rating); $i++)
            <div  class="d-flex flex-row  my-5">
                        <div class="fa-item col-md-3 col-sm-4">
                          <i class="fa fa-star" style="color:#F7D060;"></i></div>                         
                        </div>
               @endfor
           
            
            </div>
												 <div class=" content tags py-0 px-5 mt-5 mx-5">
												   
													<form id="blog_rating_form"  method="POST">
  @csrf
  <input type="hidden" name="rated_blog_id" value="{{ $blog->id }}">
  <div class="form-group ">
  <span class="text-dark mr-2 font-size-lg font-weight-bolder pb-3">
                    Rate Blog
                </span>
            
    <select class="form-control w-25" id="rating" name="rating">
      <option value="1">1 star</option>
      <option value="2">2 stars</option>
      <option value="3">3 stars</option>
      <option value="4">4 stars</option>
      <option value="5">5 stars</option>
    </select>
  </div>
  <!-- <button type="submit" class="btn btn-primary">Submit Rating</button> -->
  <button id="rateBlog" class="btn btn-light-dark font-weight-bold ">Rate Blog</button>
</form>
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
												<h6>{{$comment->name}}</h6>
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