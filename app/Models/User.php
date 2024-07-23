<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\TechnicalSupportGroup;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends AuthenticatableUser implements Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'dni',
        'email',
        'phone',
        'rol',
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
    ];

    public function adminlte_image(){
        return Auth()->user()->avatar == null ? asset('images/avatar_default.png') : Auth()->user()->avatar;
    }

    public function adminlte_profile_url()
    {
        return route('profile');
    }

    
    /**
     * Set the columns to be used by the auth.
     *
     * @return array
     */
    public function setAuthColumns()
    {
        return ['email', 'dni', 'name', 'address'];
    }

    /**
     * Get the phone associated with the user.
     */
    public function group(): BelongsToMany
    {
        return $this->belongsToMany(TechnicalSupportGroup::class);
    }

    /**
     * Get the phone associated with the user.
     */
    public function finisheds(): HasMany
    {
        return $this->hasMany(Finished::class);
    }

}
