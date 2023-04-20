<?php

namespace App\Traits;

use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait likable
{
    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class,'likable');
    }
}