<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'recruiter_profile_id',
        'title',
        'description',
        'required_skills',
        'location',
        'work_model',
        'employment_type',
        'salary_min',
        'salary_max',
        'status',
    ];

    protected $casts = [
        'required' => 'array',
    ];

    public function recruiterProfile()
    {
        return $this->belongsTo(RecruiterProfile::class);
    }
}