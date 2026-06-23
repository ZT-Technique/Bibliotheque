<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
        'is_admin',
        'role',
        'approval_status',
        'approval_note',
        'profile_photo',
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
        'is_admin' => 'boolean',
    ];

    public function getEffectiveRoleAttribute(): string
    {
        if (!empty($this->role)) {
            return $this->role;
        }

        return $this->is_admin ? 'admin' : 'apprenant';
    }

    public function isApproved(): bool
    {
        return ($this->approval_status ?? 'approved') === 'approved';
    }

    public function hasLibraryRole(array $roles): bool
    {
        return in_array($this->effective_role, $roles, true);
    }

    public function downloads()
    {
        return $this->hasMany(UserDownload::class);
    }

    public function favorites()
    {
        return $this->hasMany(UserFavorite::class);
    }

    public function favoriteArticles()
    {
        return $this->belongsToMany(Article::class, 'user_favorites')
            ->withTimestamps();
    }


}
