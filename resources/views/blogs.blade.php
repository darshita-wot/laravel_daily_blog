@extends('layout/home')
@section('title')
<title>Blogs</title>
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

<div class="card card-custom">

<div class="card-header flex-wrap border-0 pt-6 pb-0">
<ul class="nav nav-tabs nav-tabs-line">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">My Blog</a>
    </li>
    @can('create-blog-posts')
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">Write Blog</a>
    </li>
    @endcan
    <li class="nav-item">
        <a class="nav-link editBlogTab" data-toggle="tab" href="#kt_tab_pane_3">Edit Blog</a>
    </li>
   
</ul>
</div>

<div class="card-body">
<div class="tab-content mt-5" id="myTabContent">
    <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_2">

    @if($blogs->blogs->isEmpty())
    <p>No Records found</p>
    @else
    @foreach($blogs->blogs as $blog)
    <div class="content flex-column-fluid p-2" id="{{ $blog->id }}blog">
                       <div class="card card-custom" >
                                
                           <div class="card-header">
                               <div class="card-title">
                                   <span class="card-icon">
                                       <i class="flaticon2-chat-1 text-primary"></i>
                                   </span>
                                   <h3 class="card-label">{{ $blog->title }}
                                   <small>  By {{ $blogs->name }}</small>
                                    </h3>
                               </div>                              
                           </div>
                           <div class="card-body ">
                                 <div class="photo w-25 mx-auto"> 
                                 <a data-fancybox='By {{ $blog->name }}' data-caption='{{ $blog->title }}' href="/storage/{{$blog->image}}">
                                     <img src="/storage/{{$blog->image}}" width="100%" height="100%" class="card-img-top rounded" alt="Error fetching image">
                                 </a>
                            
                                 </div>
                                 <div class="content">
                                 {!! Str::limit($blog->content,50) !!}
                                </div>
                                <div class=" content tags py-0 px-5 mx-5">
                                    <b>Tags:- </b> {{$blog -> tags}}
                                </div>
                           </div>
                           <div class="{{ $blog->id }}footer card-footer justify-content-between">
                               
                               <button id='blog-no{{$blog->id}}'  class="btn btn-outline-secondary font-weight-bold readMore">Read more</button>
                               
                               @can('delete-blog-posts')
							      <button  class="deleteBlog btn btn-sm btn-primary ml-3" id='deleteBlog{{$blog->id}}'>Delete</button>
                                @endcan
                                  <!-- href="/blog/edit/{{$blog->id}}" -->
                                  @can('edit-blog-posts')
									<button  id='editBlog{{$blog->id}}' class="editBlog m-2 btn btn-success"> Edit </button>
								 @endcan
                           </div>
                       </div>
           </div>
 @endforeach
 @endif
    <!-- add blog content -->
</div>
    <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
    <div class="card card-custom">

<div class="card-header">
  <h3 class="card-title">
   Write your blog here
  </h3>
</div>
            <!--begin::Form-->
 <form class="form" id="addBlogForm"  method="POST" enctype="multipart/form-data" >
    
    <div class="card-body">
     
     <div class="form-group">
      <label>Blog Title</label>
      <input type="text" name="title" class="form-control form-control-solid" placeholder="Enter Blog Title"/>
            @if($errors->has('title'))
                <span class="text-danger"> {{$errors->first('title')}}</span>
            @endif
           <br> <span class="text-danger" id="error_title"></span>
     </div>
     <div class="form-group">
      <label for="blogContent">Content</label>
      <textarea name="content" id="content"></textarea>
              
     
            @if($errors->has('blogContent'))
                <span class="text-danger"> {{$errors->first('blogContent')}}</span>
            @endif
            
     </div>
     <div class="form-group">
      <label for="tag">Tags</label>
      <!-- <input type="text" name="tags" class="form-control form-control-solid" placeholder="Enter Tags related to your blog"/> -->
      <div class="col-lg-4 col-md-9 col-sm-12">
		<select class="form-control form-control-solid select2" id="kt_select2_3" name="tag" multiple="multiple" style="width:300px">
            @foreach($blogs->tags as $tag)
            <option value="{{$tag->name}}">{{$tag->name}}</option>
            @endforeach                                          
		</select>
        <label id="kt_select2_3-error" class="text-danger error" for="kt_select2_3"></label>
     </div>
     </div>
     
     <div class="form-group">
     <label for="img">Select image:</label>
     <input type="file" class="form-control form-control-solid" id="img" name="img" accept="image/*">
            <br><span class="text-danger" id="error_img"></span>
     </div>
    </div>
    <div class="card-footer">
     <input type="submit" value="Submit" class="btn btn-primary mr-2">
    </div>
   </form>
   <!--end::Form-->
</div>
<!-- end add blog -->

    </div>
    <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_3">
    <div class="card card-custom">

<div class="card-header">
  <h3 class="card-title">
   Update blog 
  </h3>
</div>
            <!--begin::Form-->
 <form class="form" id="updateBlogForm"  method="POST" enctype="multipart/form-data" >
    
    <div class="card-body">
     
     <div class="form-group">
      <label>Blog Title</label>
      <input type="text" name="title" class="form-control form-control-solid" id="blogTitle" placeholder="Enter Blog Title"/>
            @if($errors->has('title'))
                <span class="text-danger"> {{$errors->first('title')}}</span>
            @endif
            <input class="form-control form-control-lg
                             form-control-solid" name="id" type="hidden" id="blog_id">
           <br> <span class="text-danger" id="error_title"></span>
     </div>
     <div class="form-group">
      <label for="blogContent">Content</label>
      <textarea name="content" id="blogContent"></textarea>
              
     
            @if($errors->has('blogContent'))
                <span class="text-danger"> {{$errors->first('blogContent')}}</span>
            @endif
            
     </div>
     <div class="form-group">
      <label for="tag">Tags</label>
      <!-- <input type="text" name="tags" class="form-control form-control-solid" placeholder="Enter Tags related to your blog"/> -->
      <div class="col-lg-4 col-md-9 col-sm-12">
		<select class="form-control form-control-solid select2" id="kt_edit_select2_3" name="tag" multiple="multiple" style="width:300px">
            @foreach($blogs->tags as $tag)
            <option value="{{$tag->name}}">{{$tag->name}}</option>
            @endforeach                                          
		</select>
        <label id="kt_select2_3-error" class="text-danger error" for="kt_select2_3"></label>
     </div>
     </div>
     
     <div class="form-group">
     <label for="img">Select image:</label>
     <div class="image-input image-input-outline" id="kt_image_1">
                        <div class="image-input-wrapper" id="bgImage" style="background-image: url(demo8/dist/assets/media/users/100_1.jpg)"></div>

						<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="profile_avatarr"  accept=".png, .jpg, .jpeg">
							<input type="hidden" name="profile_avatar_remove">
                        </label>

						<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
     </div>
     </div>
    </div>
    <div class="card-footer">
     <input type="submit" value="Update" class="btn btn-primary mr-2">
    </div>
   </form>
   <!--end::Form-->
</div>
<!-- end add blog -->
    </div>
    <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel" aria-labelledby="kt_tab_pane_4">Tab content 5</div>
</div>
</div>

</div>

@endsection

@section('script')
<!--begin::Page Vendors(used by this page)-->

<script src="{{asset('demo8/dist/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js?v=7.2.9')}}"></script>
                        <!--end::Page Vendors-->
@endsection

