<?php

namespace App\Traits;
use App\Models\Follow;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

trait Followable
{
    public function follows(): MorphMany
    {
        return $this->morphMany(Follow::class,'followable');
    }

    public function addFollow($model)
    {
        try {
            
            $model->follows()->updateOrCreate(
                ['user_id' => Auth::user()->id],
            );
        } catch (\Exception $e) {
            Log::error('Like Error : Message : ' . $e->getMessage());
        }
    }
}