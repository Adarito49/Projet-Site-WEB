<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Rating;
use App\Models\Offer;
use App\Models\Applied;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
		'phone_number',
		'center',
		'promotion',
		'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ]; 

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Offer::class, 'favorites', 'user_id', 'offer_id')->withTimestamps();
    }

    public function appliedOffers()
    {
        return $this->hasManyThrough(Offer::class, Applied::class, 'user_id', 'id', 'id', 'offer_id');
    }
	
	public function isAdmin()
    {
        return $this->role === 'admin';
    }
    public function isPilot()
    {
        return $this->role === 'pilot';
    }
}