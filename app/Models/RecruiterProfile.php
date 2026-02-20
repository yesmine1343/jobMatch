<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruiterProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'industry',
        'company_size',
        'default_hiring_location',
        'default_work_model',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobOffers()
    {
        return $this->hasMany(JobOffer::class);
    }
}