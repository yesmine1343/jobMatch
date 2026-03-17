<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('candidate_profiles', function (Blueprint $table) {
            $table->json('skills')->nullable()->after('location_preference');
            $table->enum('education_level', ['High School', 'Bachelor', 'Master', 'PhD'])->nullable()->after('skills');
        });
    }

    public function down()
    {
        Schema::table('candidate_profiles', function (Blueprint $table) {
            $table->dropColumn(['skills', 'education_level']);
        });
    }
};