<?php

namespace App\Repositories;
use App\Contracts\CountContracts;
use App\Models\Blog;
use App\Models\Count;
use App\Models\User;
use App\Traits\Followable;
use App\Traits\Likable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

Class CountRepository implements CountContracts
{
    use Likable,Followable;
    private $apiReturnData = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

     public function setLike()
    {
        $blog = Blog::find($this->request->id);
        
        $this->saveLike($blog);
        
        $like_count = $blog->likes()
             ->whereHasMorph('likable', [Blog::class], function($query) {
            $query->where('likable_id',$this->request->id);
       })->withCount('likable')
       ->count();
        
        return $like_count;
    }

    public function disLikeBlog()
    {
        $blog = Blog::find($this->request->id);
        Log::info('dislike blog',[$blog]);
        $like = $blog->likes()->where('user_id',Auth::user()->id)->delete();

        $like_count = $blog->likes()
             ->whereHasMorph('likable', [Blog::class], function($query) {
            $query->where('likable_id',$this->request->id);
       })->withCount('likable')
       ->count();
        
        return $like_count;
    }

    public function followUser()
    {
        $user = User::find($this->request->id);

        $this->addFollow($user);

        $follower_count = $user->follows()
        ->whereHasMorph('followable', [User::class], function($query) {
          $query->where('followable_id',$this->request->id);
          })->withCount('followable')
          ->count();

          return $follower_count;
    }

    public function unfollowUser()
    {
        $user = User::find($this->request->id);
        $follow = $user->follows()->where('user_id',Auth::user()->id)->delete();
        Log::info('follow removed',[$follow]);

        $follower_count = $user->follows()
        ->whereHasMorph('followable', [User::class], function($query) {
          $query->where('followable_id',$this->request->id);
          })->withCount('followable')
          ->count();

          return $follower_count;
    }
}