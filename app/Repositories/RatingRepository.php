<?php

namespace App\Repositories;

use App\Contracts\RatingContracts;
use App\Models\Blog;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Traits\Ratable;

class RatingRepository implements RatingContracts
{
    use Ratable;
    private $apiReturnData = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function rateUser()
    {
        $user = User::find($this->request->rated_user_id);

        $data['user_id'] = Auth::user()->id;
        $data['rating'] = $this->request->rating;

        $this->saveRating($user,$data);

        $averageRating = $user->ratings()->avg('rating');

        Log::info('average = ', [$averageRating]);
        return $averageRating;
    }

    public function rateBlog()
    {
        $blog = Blog::find($this->request->rated_blog_id);

        $data['user_id'] = Auth::user()->id;
        $data['rating'] = $this->request->rating;

        $this->saveRating($blog,$data);

        $averageRating = $blog->ratings()->avg('rating');

        Log::info('average rating of blog = ', [$averageRating]);
        return $averageRating;
    }
}