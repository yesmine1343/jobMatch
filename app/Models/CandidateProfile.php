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
        'expected_salary',
        'availability',
        'location_preference',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}