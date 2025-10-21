<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enum\ApprovalStatus;
use App\Enum\UserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
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
        'phone',
        'country_code',
        'phone_number',
        'password',
        'type',
        'is_active',
        'about_me',
        'profile_picture',
        'company',
        'approval_status',
        'email_verified_at',
        'country',
        'city',
        'is_verified',
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
        'is_active'         => 'boolean',
        'is_verified'       => 'boolean',
        'user_type'         => UserType::class,
        'approval_status'   => ApprovalStatus::class
    ];

    protected $with = ['verification', 'reviews'];

    protected $appends = [
        'user_verification_status',
        'rate',
        'rate_count'
    ];

    public function getUserVerificationStatusAttribute()
    {
        return $this->verification ? $this->verification->status : null;
    }

    public function getRateAttribute()
    {
        return $this->reviews != null ? round($this->reviews?->avg('rating'), 2) : 0;
    }

    public function getRateCountAttribute()
    {
        return $this->reviews != null ? $this->reviews?->count() : 0;
    }

    #[Scope]
    protected function freelancers(Builder $query): Builder
    {
        return $query->where('type', UserType::FREELANCER);
    }

    #[Scope]
    protected function clients(Builder $query): Builder
    {
        return $query->where('type', UserType::CLIENT);
    }

    public function freelancerProfile()
    {
        return $this->hasOne(FreelancerProfile::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'user_skills', 'user_id', 'skill_id');
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'user_languages')
            ->withPivot('language_level')
            ->withTimestamps();
    }

    public function verification()
    {
        return $this->hasOne(UserVerification::class);
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
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
