<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\Rating;
use App\Models\Tag;
use App\Models\User;
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
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'tags',
        'image'
    ];

    public static function boot(){

        parent::boot();

        static::created(function(){
            Log::info('NEW BLOG CREATED');
        });

        static::updated(function(){
            Log::info('BLOG UPDATED');
        });
        
        static::saved(function(){
            Log::info('BLOG SAVED');
        });

        static::deleted(function(){
            Log::info('BLOG DELETED');
        });
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class,'blog_id','id');
    }
    
    public function counts(): MorphMany
    {
        return $this->morphMany(Count::class,'countable');
    }

    public function ratings(): MorphMany
    {
        return $this->morphMany(Rating::class,'ratingable');
    }
}
