<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('project_categories')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('location');
            $table->string('client_name')->nullable();
            $table->string('covered_area')->nullable();
            $table->string('membrane_material')->nullable();
            $table->integer('year_completed')->nullable();
            $table->text('short_description');
            $table->longText('full_overview')->nullable();
            $table->text('structural_challenge')->nullable();
            $table->text('engineering_solution')->nullable();
            $table->string('thumbnail_image');
            $table->boolean('is_featured')->default(false);
            $table->string('status')->default('published');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
