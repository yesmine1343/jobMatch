<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('recruiter_profiles', function (Blueprint $table) {
            // First, rename the columns
            $table->renameColumn('default_hiring_location', 'hiring_location');
            $table->renameColumn('default_work_model', 'work_model');
        });

        // Then, modify work_model in a separate Schema call
        Schema::table('recruiter_profiles', function (Blueprint $table) {
            $table->enum('work_model', ['Remote', 'Hybrid', 'On-site'])->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('recruiter_profiles', function (Blueprint $table) {
            $table->renameColumn('default_hiring_location', 'hiring_location');
            $table->renameColumn('default_work_model', 'work_model');
        });
    }
};