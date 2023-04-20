<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Log;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'blog_owner_id',
        'text',
    ];

    public static function boot(){

        parent::boot();

        static::created(function(){
            Log::info('NEW COMMENT ADDED');
        });

        static::updated(function(){
            Log::info('COMMENT Approved');
        });
        
        static::saved(function(){
            Log::info('COMMENT SAVED');
        });

        
    }
    
    // public function blog():BelongsTo
    // {
    //     return $this->belongsTo(Blog::class,'blog_id','id');
    // }

    public function commentable()
    {
        return $this->morphTo();
    }
        
}
