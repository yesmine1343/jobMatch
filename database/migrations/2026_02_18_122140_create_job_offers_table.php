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
        Schema::create('job_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recruiter_profile_id')->constrained()->onDelete('cascade');
            
            $table->string('title');
            $table->text('description');
            $table->json('required_skills');
            $table->string('location');
            $table->enum('work_model', ['Remote', 'Hybrid', 'On-site']);
            $table->enum('employment_type', ['Full-time', 'Part-time', 'Contract', 'Internship']);
            $table->integer('salary_min')->nullable();
            $table->integer('salary_max')->nullable();
            $table->enum('status', ['active', 'closed', 'draft'])->default('active');
            
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('job_offers');
    }
};
