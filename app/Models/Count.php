<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Count extends Model
{
    use HasFactory;

    protected $fillable = [
       'total',
       'user_id'
    ];

    public function countable()
    {
        return $this->morphTo();
    }
}