<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'skills',
        'type',
        'company_id',
        'duration',
        'salary',
        'date',
        'number',
        'email',
        'postal_code',
        'city',
        'offer_description',
    ];

    public function company() {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
