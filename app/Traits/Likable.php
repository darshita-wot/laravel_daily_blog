<?php

namespace App\Traits;

use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

trait likable
{
    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class,'likable');
    }

    public function saveLike($model)
    {
        try {
            
            $model->likes()->updateOrCreate(
                ['user_id' => Auth::user()->id],
            );
        } catch (\Exception $e) {
            Log::error('Like Error : Message : ' . $e->getMessage());
        }
    }
}