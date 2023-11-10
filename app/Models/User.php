<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

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


    public function role()
    {
        return $this->hasOne(Role::class);
    }

    public function hasRole($roles)
    {

        if (count(array_intersect($roles, array($this->role))) > 0) {
            return true;
        }

    }

    public function hasPermission($permissions)
    {
        $permissionName = $this->permissions()->pluck('name')->toArray();
        if (count(array_intersect($permissions, $permissionName)) > 0) {
            return true;
        }
    }

    public function hasAnyRole(...$roles)
    {
        //  dd($this->role);
        return $this->hasRole(...$roles);
    }

    public function hasAnyPermission(...$permissions)
    {
        // dd(...$permissions);
        return $this->hasPermission(...$permissions);
    }

    public function permissions()
    {
        $role = Role::where('name', $this->role)->first();
        return $role->permissions;
    }

}
