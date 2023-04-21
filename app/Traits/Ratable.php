<?php

namespace App\Traits;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Log;

trait Ratable
{
    public function ratings(): MorphMany
    {
        return $this->morphMany(Rating::class, 'ratable');
    }

    public function saveRating($model, $data)
    {
        try {
            $model->ratings()->updateOrCreate(
                ['user_id' => $data['user_id']],
                ['rating' => $data['rating']]
            );
        } catch (\Exception $e) {
            Log::error('Error Message : ' . $e->getMessage());
        }
    }



}