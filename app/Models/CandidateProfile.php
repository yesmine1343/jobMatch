<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'target_job_title',
        'experience_level',
        'work_type',
        'employment_type',
        'location_preference',
        'skills',
        'education_level',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}