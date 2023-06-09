<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Blog;
use App\Models\Tag;
use App\Traits\Commentable;
use App\Traits\Followable;
use App\Traits\Ratable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles,SoftDeletes,Ratable,Followable,Commentable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile_no',
        'birth_date',
        'profile_photo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot(){

        parent::boot();

        static::created(function($user){
            Log::info('NEW USER CREATED - ',[$user->name]);
        });

        static::updating(function($user){
            Log::info('USER UPDATING',[$user->name]);

            $changes = $user->getDirty();
            foreach ($changes as $attribute => $value) {
                Log::info("User {$user->id}: {$attribute} changed from '{$user->getOriginal($attribute)}' to '{$value}'");
            }
           
           
        });

        static::updated(function($user){
            Log::info('USER UPDATED',[$user->name]);
            // $oldData = $user->getOriginal();
            // $newData = $user->getAttributes();
            // Log::info('Old User - ',[$oldData['name']]);
            // Log::info('Old User - ',[$oldData]);
            // Log::info('New User - ',[$newData]);
        });
        
        static::saved(function($user){
            Log::info('USER INFO SAVED',[$user->name]);
        });

        static::deleted(function($user){
            Log::info('USER DELETED',[$user->name]);
        });
    }

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class);
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }

}
