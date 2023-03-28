<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Rating extends Model
{
    protected $fillable = ['user_id', 'company_id', 'rating'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}

