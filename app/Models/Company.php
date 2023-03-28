<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rating;

class Company extends Model
{
    use HasFactory;
	
	protected $table = 'companies';

    protected $fillable = [
        'company_name',
        'sector',
        'street_number',
        'street_name',
        'postal_code',
        'city',
        'building',
        'floor',
        'interns_number',
        'pilot_trust',
    ];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
