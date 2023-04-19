<?php

namespace App\Repositories;

use App\Contracts\RatingContracts;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RatingRepository implements RatingContracts
{
    private $apiReturnData = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function rateUser()
    {
        $user = User::find($this->request->rated_user_id);

        $user->ratings()->updateOrCreate(
            ['user_id' => Auth::user()->id],
            ['rating' => $this->request->rating]
        );

        $averageRating = $user->ratings()->avg('rating');

        Log::info('average = ', [$averageRating]);
        return $averageRating;
    }
}