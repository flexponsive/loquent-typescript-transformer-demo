<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\AsStringable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;

/** @typescript */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'password' => 'hashed',
        'role' => \App\Enums\UserRole::class,
        // skip bigint_without_casts
        'names_of_siblings' => 'array',
        'secret_question' => \Illuminate\Database\Eloquent\Casts\AsStringable::class,
        'is_active' => 'boolean',
        'cohort_month' => 'immutable_date:Y-m-01',
        'signup_fee' => 'decimal:2',
        'rand_double' => 'double',
        'secret_answer' => 'encrypted',
        'rand_float' => 'float',
        'options' => 'object',
        'login_count' => 'integer',
        'last_login_ts' => 'timestamp',
    ];

    public function orgUnit(): HasOne
    {
        return $this->hasOne(OrgUnit::class);
    }

    protected function reverseEmail(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => strrev($attributes['email']),
        );
    }
}
