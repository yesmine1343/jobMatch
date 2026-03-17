<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('job_offers', function (Blueprint $table) {
            // Add department column to track job department
            if (!Schema::hasColumn('job_offers', 'department')) {
                $table->string('department')->nullable()->after('title');
            }

            // Add optional skills for nice-to-have qualifications
            if (!Schema::hasColumn('job_offers', 'optional_skills')) {
                $table->json('optional_skills')->nullable()->after('required_skills');
            }

            // Add soft skills requirements
            if (!Schema::hasColumn('job_offers', 'soft_skills')) {
                $table->json('soft_skills')->nullable()->after('optional_skills');
            }
        });
    }

    public function down()
    {
        Schema::table('job_offers', function (Blueprint $table) {
            $table->dropColumnIfExists('department');
            $table->dropColumnIfExists('optional_skills');
            $table->dropColumnIfExists('soft_skills');
        });
    }
};
