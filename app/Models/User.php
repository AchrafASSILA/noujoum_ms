<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Role\Role;
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
        'role',
        'image',
        'active',
        'adress',
        'age',
        'tel',
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


    // relations
    public function roles()
    {
        return $this->belongsTo(Role::class, 'role');
    }
    // functions
    public function getImage()
    {

        $path =   '/storage/users/'  . $this->image;
        if ($this->image) {
            return $path;
        }
        return 'https://cdn-icons-png.freepik.com/512/3177/3177440.png';
    }
    public function getFullName()
    {

        return strtoupper($this->name);
    }
}
