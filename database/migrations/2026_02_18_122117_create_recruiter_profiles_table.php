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
        Schema::create('recruiter_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->string('company_name');
            $table->string('industry');
            $table->enum('company_size', ['1-10', '11-50', '51-200', '201-500', '500+']);
            $table->string('default_hiring_location')->nullable();
            $table->enum('default_work_model', ['Remote', 'Hybrid', 'On-site']);
            
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('recruiter_profiles');
    }
};
