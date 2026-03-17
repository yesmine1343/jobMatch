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
        'department',
        'description',
        'required_skills',
        'optional_skills',
        'soft_skills',
        'location',
        'work_model',
        'employment_type',
        'required_education',
        'required_experience_level',
        'salary_min',
        'salary_max',
        'status',
    ];

    protected $casts = [
        'required_skills'  => 'array',
        'optional_skills'  => 'array',
        'soft_skills'      => 'array',
    ];

    protected $appends = ['jobTitle'];

    public function getJobTitleAttribute()
    {
        return $this->title;
    }

    public function recruiterProfile()
    {
        return $this->belongsTo(RecruiterProfile::class);
    }
}