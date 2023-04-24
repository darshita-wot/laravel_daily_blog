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
        'name'
    ];

    public static function boot(){

        parent::boot();

        static::created(function($comment){
            Log::info('NEW COMMENT ADDED',[$comment->text]);
        });

        static::updated(function($comment){
            Log::info('COMMENT Approved',[$comment->text]);
        });
        
        static::saved(function($comment){
            Log::info('COMMENT SAVED',[$comment->text]);
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
