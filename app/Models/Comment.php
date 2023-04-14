<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_name',
        'blog_id',
        'blog_owner_id',
        'text',
    ];

    public function blog():BelongsTo
    {
        return $this->belongsTo(Blog::class,'blog_id','id');
    }
        
}
