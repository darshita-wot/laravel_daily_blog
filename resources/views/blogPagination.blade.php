@foreach($blogs as $blog)
    <div class="content flex-column-fluid p-2" id="{{ $blog->id }}blog">
                       <div class="card card-custom" >
                                
                           <div class="card-header">
                               <div class="card-title">
                                   <span class="card-icon">
                                       <i class="flaticon2-chat-1 text-primary"></i>
                                   </span>
                                   <h3 class="card-label">{{ $blog->title }}
                                   <small>  By {{ $blog->name }}</small>
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
                               
                               @role('admin')
							      <button  class="deleteBlog btn btn-sm btn-primary ml-3" id='deleteBlog{{$blog->id}}'>Delete</button>
                                @endrole
                                  <!-- href="/blog/edit/{{$blog->id}}" -->
									<button  id='editBlog{{$blog->id}}' class="editBlog m-2 btn btn-success"> Edit </button>
									
                           </div>
                       </div>
           </div>
 @endforeach