<?php

namespace App\Repositories;
use App\Contracts\CommentContracts;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommentRepository implements CommentContracts
{
    private $apiReturnData = [];

    public function __construct(Comment $comment, Request $request)
    {
        $this->model = $comment;
        $this->request = $request;
    }

    // $user = User::find($this->request->id);
    // $follow = $user->follows()->updateOrCreate(
    //     ['user_id' => Auth::user()->id],
    // );
    // Log::info('follow added',[$follow]);

    // $follower_count = $user->follows()
    // ->whereHasMorph('followable', [User::class], function($query) {
    //   $query->where('followable_id',$this->request->id);
    //   })->withCount('followable')
    //   ->count();

    //   return $follower_count;

    public function addcomment($blog_id){
        $blog = Blog::find($blog_id);
        $comment = $blog->comments()->create([
            'user_id' => Auth::id(),
            'blog_owner_id' => $this->request->blog_owner_id,
            'text' => $this->request->comment
        ]);
        Log::info('comment',[$comment]);
        return $comment;
    }
}