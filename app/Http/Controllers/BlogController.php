<?php

namespace App\Http\Controllers;

use App\Contracts\BlogContracts;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function __construct(Request $request, BlogContracts $blogContracts)
    {
        $this->request = $request;
        $this->repo = $blogContracts;
    }

    public function uploadBlogImg(){
        
        try{
            $data = $this->repo->uploadBlogImg();
            return response()->json(['status' => $data['status'], 'url' => $data['url']]);
        }catch(Exception $e){
            return response()->json(['failed' => $e->getMessage()]);
        }
    }

    public function userBlogs(){
        try{
            $blogs = $this->repo->userBlogs();
            
            // Log::info('user blogs',[$blogs]);
            return view('blogs',compact('blogs'));

        }catch(Exception $e){
            return response()->json(['failed' => $e->getMessage()]);
        }
    }

    public function addBlog(){
       
        try{
            $validator = Validator::make($this->request->all(),[
                'title' => 'string|required|min:5',
                // 'tag' => 'required',
                'content' => 'required'
            ],[
                'title.string' => 'Invalid Template name',
                'title.min' =>'The template name must be at least 5 characters.',
                'content.string' => 'Invalid content'
            ]);
    
            if(!$validator->passes()){
                return response()->json(['status' => 'false','error'=>$validator->errors()]);
            }else{
                $blog = $this->repo->addBlog();
                if (!empty($blog)) {
                    return response()->json(['status' => 'success', 'data' => 'blog added']);
                } else {
                    return response()->json(['error' => 'Error in adding blog']);
                }
            }
        }catch(Exception $e){
            return response()->json(['failed' => $e->getMessage()]);
        }
       
    }

    public function allBlogs(){
        try{
            $all_blogs = $this->repo->allBlogs();
            
            Log::info('all blogs',[$all_blogs]);
            return view('allBlogs',compact('all_blogs'));

        }catch(Exception $e){
            return response()->json(['failed' => $e->getMessage()]);
        }
    }

    public function editBlog(string $id){
        try{
            $blog = $this->repo->editBlog($id);
            if (!empty($blog)) {
                return response()->json(['status' => 'success', 'data' => $blog]);
            } else {
                return response()->json(['error' => 'Error in adding blog']);
            }
        }catch(Exception $e){
            return response()->json(['failed' => $e->getMessage()]);
        }
    }

    public function updateBlog(){
    
        try{
            $validator = Validator::make($this->request->all(),[
                'title' => 'string|required|min:5',
                // 'tag' => 'required',
                'content' => 'required'
            ],[
                'title.string' => 'Invalid Template name',
                'title.min' =>'The template name must be at least 5 characters.',
                'content.string' => 'Invalid content'
            ]);
    
            if(!$validator->passes()){
                return response()->json(['status' => 'false','error'=>$validator->errors()]);
            }else{
                $blog = $this->repo->updateBlog();
                if (!empty($blog)) {
                    return response()->json(['status' => 'success', 'data' => 'Blog Updated']);
                } else {
                    return response()->json(['error' => 'Error updating blog']);
                }
            }
        }catch(Exception $e){
            return response()->json(['failed' => $e->getMessage()]);
        }
    }

    public function deleteBlog(string $id){
        try{
            $status = $this->repo->deleteBlog($id);
            if($status){
                return response()->json(['status'=>'success','data' => 'Blog deleted']);
            }else{
                return response()->json(['status'=>'error','data' => 'Blog not deleted']);
            }
        }catch(Exception $e){
            return response()->json(['failed' => $e->getMessage()]);
        }
    }

    public function singleBlog(string $id){
        $blog_data = $this->repo->singleBlog($id);
        $blog = $blog_data['blog_data'];
        $rating = $blog_data['averageRating'];
        return view('singleBlog',compact('blog','rating'));
    }
}
