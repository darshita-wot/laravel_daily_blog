<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\Rating;
use App\Models\Tag;
use App\Models\User;
use App\Traits\Commentable;
use App\Traits\Likable;
use App\Traits\Ratable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Blog extends Model
{
    use HasFactory,SoftDeletes,Ratable,Likable,Commentable;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'tags',
        'image'
    ];

    public static function boot(){

        parent::boot();

        static::created(function($blog){
            Log::info('NEW BLOG CREATED',[$blog->title]);
        });

        static::updated(function($blog){
            Log::info('BLOG UPDATED',[$blog->title]);
        });
        
        static::saved(function($blog){
            Log::info('BLOG SAVED',[$blog->title]);
        });

        static::deleted(function($blog){
            Log::info('BLOG DELETED',[$blog->title]);
        });
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // public function comments(): HasMany
    // {
    //     return $this->hasMany(Comment::class,'blog_id','id');
    // }

}
