<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('job_offers', function (Blueprint $table) {
            // Add education requirement to jobvue & controller
            $table->enum('required_education', ['High School', 'Bachelor', 'Master', 'PhD'])->nullable()->after('employment_type');
            
            // Add required experience level to jobvue & controller
            $table->enum('required_experience_level', ['Junior', 'Mid', 'Senior', 'Lead'])->after('required_education');
        });
    }

    public function down()
    {
        Schema::table('job_offers', function (Blueprint $table) {
            $table->dropColumn(['required_education', 'required_experience_level']);
        });
    }
};