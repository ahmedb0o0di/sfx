<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estimator_leads', function (Blueprint $table) {
            $table->id();
            $table->string('structure_type');
            $table->decimal('footprint_area', 10, 2);
            $table->string('membrane_choice');
            $table->decimal('calculated_tonnage', 8, 2)->nullable();
            $table->string('estimated_weeks')->nullable();
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone');
            $table->string('company_name')->nullable();
            $table->string('project_location')->nullable();
            $table->text('additional_notes')->nullable();
            $table->string('status')->default('new');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estimator_leads');
    }
};
