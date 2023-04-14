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

    public function addcomment($blog_id){
        $comment = Comment::create([
            'user_name' => Auth::user()->name,
            'blog_id' => $blog_id,
            'blog_owner_id' => $this->request->blog_owner_id,
            'text' => $this->request->comment
        ]);
        Log::info('comment',[$comment]);
        return $comment;
    }
}