<?php

namespace App\Traits;
use App\Models\Rating;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Ratable
{
    public function ratings(): MorphMany
    {
        return $this->morphMany(Rating::class,'ratable');
    }
}