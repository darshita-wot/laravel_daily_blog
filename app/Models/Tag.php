<?php

namespace App\Models;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Tag extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'name'
    ];

    public static function boot()
    {

        parent::boot();

        static::created(function () {
            Log::info('NEW TAG CREATED');
        });

        static::updating(function () {
            Log::info('TAG UPDATING');
        });

        static::updated(function () {
            Log::info('TAG UPDATED');
        });

        static::saved(function () {
            Log::info('TAG INFO SAVED');
        });

        static::deleted(function () {
            Log::info('TAG DELETED');
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}