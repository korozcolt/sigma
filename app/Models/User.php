<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

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
        'role',
        'session_id',
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
        'last_login_at' => 'datetime',
        'last_logout_at' => 'datetime',
        'last_activity' => 'datetime',
    ];

    protected function password(): Attribute{
        return Attribute::make(
            set: fn($value) => Hash::make($value)
        );
    }

    public function coordinator()
    {
        return $this->hasOne(Coordinator::class);
    }

    public function leader()
    {
        return $this->hasOne(Leader::class);
    }

    public function hasRole($roles)
    {
        if (is_string($roles)) {
            return $this->role === $roles;
        }

        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }

        return false;
    }

    public function isAdmin()
    {
        return $this->role === 'admin' || $this->role === 'super_admin';
    }

    public function isLeader()
    {
        return $this->role === 'leader';
    }

    public function isCoordinator()
    {
        return $this->role === 'coordinator';
    }

    public function isDigitizer()
    {
        return $this->role === 'digitizer';
    }
}
