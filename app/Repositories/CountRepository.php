<?php

namespace App\Repositories;
use App\Contracts\CountContracts;
use App\Models\Blog;
use App\Models\Count;
use App\Models\User;
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
        $blog = Blog::find($this->request->id);
        $like = $blog->counts()->create([
            'user_id' => Auth::user()->id,
            'total' => 1
        ]);
        Log::info('like added',[$like]);

        $like_count = $blog->counts()
             ->whereHasMorph('countable', [Blog::class], function($query) {
            $query->where('countable_id',$this->request->id);
       })->withCount('countable')
       ->count();
        
        return $like_count;
    }

    public function followUser()
    {
        $user = User::find($this->request->id);
        $follow = $user->counts()->create([
            'user_id' => Auth::user()->id,
            'total' => 1
        ]);
        Log::info('follow added',[$follow]);

        $follower_count = $user->counts()
        ->whereHasMorph('countable', [User::class], function($query) {
          $query->where('countable_id',$this->request->id);
          })->withCount('countable')
          ->count();

          return $follower_count;
    }

    public function rateuser()
    {
        
    }
}