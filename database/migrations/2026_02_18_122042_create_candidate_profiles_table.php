<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('candidate_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->string('target_job_title');
            $table->enum('experience_level', ['Junior', 'Mid', 'Senior', 'Lead']);
            $table->enum('work_type', ['Remote', 'Hybrid', 'On-site']);
            $table->enum('employment_type', ['Full-time', 'Part-time', 'Contract', 'Internship']);
            $table->integer('expected_salary')->nullable();
            $table->string('availability');
            $table->string('location_preference')->nullable();
            
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('candidate_profiles');
    }
};
