<?php

namespace App\Traits;
use App\Models\Follow;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Followable
{
    public function follows(): MorphMany
    {
        return $this->morphMany(Follow::class,'followable');
    }

}