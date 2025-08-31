<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enum\ApprovalStatus;
use App\Enum\UserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Notification;
use BackedEnum;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable implements JWTSubject

{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'linkedin_link',
        'twitter_link',
        'other_freelance_platform_links',
        'portfolio_link',
        'city_id',
        'verification_type',
        'verification_value',
        'rate',
        'is_active',
        'approval_status',
        'email_verified_at',
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
        'other_freelance_platform_links' => 'array',
        'is_active' => 'boolean',
        'approval_status' => ApprovalStatus::class,
    ];

    #[Scope]
    protected function freelancers(Builder $query): Builder
    {
        return $query->where('type', UserType::FREELANCER->value);
    }

    #[Scope]
    protected function clients(Builder $query): Builder
    {
        return $query->where('type', UserType::CLIENT->value);
    }

    /**
     * Get the identifier that will be stored in the JWT token.
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return key-value array of custom JWT claims.
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
