<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('career_applications', function (Blueprint $table) {
            $table->string('interviewer_name')->nullable()->after('admin_notes');
            $table->date('interview_date')->nullable()->after('interviewer_name');
            $table->string('interview_rating')->nullable()->after('interview_date');
            $table->text('interviewer_feedback')->nullable()->after('interview_rating');
        });
    }

    public function down(): void
    {
        Schema::table('career_applications', function (Blueprint $table) {
            $table->dropColumn([
                'interviewer_name',
                'interview_date',
                'interview_rating',
                'interviewer_feedback',
            ]);
        });
    }
};

