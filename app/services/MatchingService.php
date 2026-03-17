<?php

namespace App\Services;

class MatchingService
{
    public function calculate(array $profile, array $jobRequirements, ?array $weights = null): array
    {
        if ($weights === null) {
            $weights = [
                'education' => 0.2,
                'skills' => 0.3,
                'experience' => 0.5,
            ];
        }

        $skillScore = $this->calculateSkillScore(
            $profile['skills'] ?? [],
            $jobRequirements['required_skills'] ?? []
        );

        $experienceScore = $this->calculateExperienceScore(
            $profile['experience_level'] ?? 'Mid',
            $jobRequirements['required_experience_level'] ?? 'Mid'
        );

        $educationScore = $this->calculateEducationScore(
            $profile['education_level'] ?? null,
            $jobRequirements['required_education'] ?? null
        );

        $finalScore = (
            ($skillScore * $weights['skills']) +
            ($experienceScore * $weights['experience']) +
            ($educationScore * $weights['education'])
        );

        return [
            'skill_score' => round($skillScore * 100),
            'experience_score' => round($experienceScore * 100),
            'education_score' => round($educationScore * 100),
            'final_score' => round($finalScore * 100),
        ];
    }

    private function calculateSkillScore(array $candidateSkills, array $requiredSkills): float
    {
        if (empty($requiredSkills)) {
            return 0.5;
        }

        $candidateSkills = array_map('strtolower', $candidateSkills);
        $requiredSkills = array_map('strtolower', $requiredSkills);

        $matched = array_intersect($candidateSkills, $requiredSkills);

        return count($matched) / count($requiredSkills);
    }

    private function calculateExperienceScore(string $candidateLevel, string $requiredLevel): float
    {
        $levels = [
            'Junior' => 1,
            'Mid' => 2,
            'Senior' => 3,
            'Lead' => 4
        ];

        $candidate = $levels[$candidateLevel] ?? 2;
        $required = $levels[$requiredLevel] ?? 2;

        return min($candidate / $required, 1.0);
    }

    private function calculateEducationScore(?string $candidateEducation, ?string $requiredEducation): float
    {
        if (!$requiredEducation) {
            return 1.0;
        }

        if (!$candidateEducation) {
            return 0.0;
        }

        $levels = [
            'High School' => 1,
            'Bachelor' => 2,
            'Master' => 3,
            'PhD' => 4
        ];

        $candidate = $levels[$candidateEducation] ?? 0;
        $required = $levels[$requiredEducation] ?? 2;

        return $candidate >= $required ? 1.0 : 0.0;
    }
}

/* 
We can separate:

Mandatory skills
Nice-to-have skills

Then:

Mandatory score = matched_mandatory / total_mandatory
Nice score = matched_nice / total_nice

Then combine:

skill_score =
(mandatory_score × 0.7) +
(nice_score × 0.3)

This reflects real hiring.

Recruiters care more about mandatory skills.

This is realistic AND structured.
*/