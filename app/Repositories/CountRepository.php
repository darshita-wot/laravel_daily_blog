<?php

namespace App\Repositories;
use App\Contracts\CountContracts;
use App\Models\Blog;
use App\Models\Count;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

Class CountRepository implements CountContracts
{
    private $apiReturnData = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

     public function setLike()
    {
        $exists = Count::where('countable_id',$this->request->id)->exists();
        $blog = Blog::find($this->request->id);
        // $likes = $blog->comments;
        // $upvotescount = $blog->upvotes->count();
        // Log::info('BLOG ----- ',[$blog]);

        
        if($exists){
            $count = Count::where('countable_id',[$this->request->id])->first();
            Log::info('inside if',[$blog->comments]);
            $like = $count->total;
                $total_like = $like + 1;
                $blog->counts()->update(['total'=>$total_like]);
                return $total_like;
        }else{
            
            $count = new Count;
            $count->countable_id = Auth::id();
            $count->total = 1;
            $blog->counts()->save($count);
            $total_like = 1;
            return $total_like;
        }
        
       
        // $comment->user_id = Auth::id();
        // Log::info('inside if',[$comment->commentable_id]);
        // if($comment->commentable_id == $this->request->id){
        //     Log::info('inside if');
        //     $like = int($comment->body);
        //     $total_like = $like + 1;
        //     $blog->comments()->update(['body'=>$total_like]);
        //     Log::info('total like ',[$comment->body]);
        //     $blog->comments()->save();
        //     return $comment->body;
        // }else{
        //     $comment->body = 1;
        //     $blog->comments()->save($comment);
        //     return $comment->body;
        // }

    }
}