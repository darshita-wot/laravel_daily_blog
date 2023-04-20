<?php

namespace App\Repositories;

use App\Contracts\BlogContracts;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BlogRepository implements BlogContracts
{

    private $apiReturnData = [];

    public function __construct(Tag $tag, Request $request)
    {
        $this->model = $tag;
        $this->request = $request;
    }

    public function uploadBlogImg()
    {

        Log::info("request->hasFile('upload') ----- ", [$this->request->hasFile('upload')]);
        if ($this->request->hasFile('upload')) {

            $originName = $this->request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $this->request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $this->request->file('upload')->move(public_path('storage/images'), $fileName);
            $url = asset('storage/images/' . $fileName);
            $this->apiReturnData['status'] = true;
            $this->apiReturnData['url'] = $url;
            $this->apiReturnData['fileName'] = $fileName;
            return $this->apiReturnData;
        }
    }

    public function addBlog()
    {
        // Log::info('req',[$this->request->all()]);
        if ($this->request->file('img') != null) {

            //Upload image inside public/images folder
            $image = $this->request->file('img');
            $name = $image->getClientOriginalName();
            $path = $this->request->file('img')->store('images', 'public');

            // Log::info('path',[$path]);
        }
        $blog = Blog::create([
            'title' => $this->request->title,
            'user_id' => Session('id'),
            'tags' => $this->request->tags,
            'content' => $this->request->content,
            'image' => $path,
        ]);
        Log::info('tag', [$this->request->tag]);
        return $blog;
    }

    public function userBlogs()
    {
        $id = Session('id');
        $user = User::find($id);
        $user_blogs = $user->with('blogs', 'tags')->where('id', $id)->first();
        $counts = Blog::withCount('counts','comments')->where('user_id', Session('id'))->whereNull('deleted_at')->get();
        Log::info('user blogs',[$user_blogs]);
        Log::info('counts',[$counts]);
        return $user_blogs;
    }

    public function allBlogs()
    { 
        // $blogs = Blog::with(['counts','user'])->withCount('counts','comments')->where('user_id', '!=', Session('id'))->whereNull('deleted_at')->get();
        $blogs = Blog::where('user_id', '!=', Session('id'))->whereNull('deleted_at')->with(['user','counts' => function($query){
            $query->where('user_id',Session('id'));
        }])->withCount('counts','comments')->paginate(2);
        
        return $blogs;
    }

    public function editBlog(string $id)
    {
        $blog = Blog::where('id', $id)->first();
        return $blog;
    }

    public function updateBlog()
    {
        if ($this->request->file('profile_avatar') != null) {

            //Upload image inside public/images folder
            $image = $this->request->file('profile_avatar');
            $name = $image->getClientOriginalName();
            $path = $this->request->file('profile_avatar')->store('images', 'public');

        } else {
            $blog = Blog::where('id', $this->request->id)->first();
            $path = $blog->image;
        }
        $status = Blog::where('id', $this->request->id)->update([
            'title' => $this->request->title,
            'user_id' => Session('id'),
            'tags' => $this->request->tags,
            'content' => $this->request->content,
            'image' => $path,
        ]);

        Log::info('path', [$path]);
        Log::info('status', [$status]);
        $this->apiReturnData['status'] = $status;
        $this->apiReturnData['image'] = $path;
        return $this->apiReturnData;
    }

    public function deleteBlog(string $id){
        $status = Blog::where('id',$this->request->id)->delete();
       
        return $status;
    }

    public function singleBlog(string $id){

        $blog = Blog::with(['user','comments' => function($query){
            $query->select('id','blog_id','user_name','text')->where('status',1);
        }])->find($id);
        $apiReturnData['blog_data'] = $blog;
        Log::info('single blog',[$blog]);
        $apiReturnData['averageRating'] = $blog->ratings()->avg('rating');
        return $apiReturnData;
    }
}