<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('long_description')->nullable();
            $table->string('category');
            $table->json('technologies'); // Array of technologies used
            $table->string('image_url');
            $table->json('gallery_images')->nullable(); // Additional project images
            $table->string('live_url')->nullable();
            $table->string('github_url')->nullable();
            $table->string('demo_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->integer('display_order')->default(0);
            $table->date('completion_date')->nullable();
            $table->string('client_name')->nullable();
            $table->decimal('project_value', 10, 2)->nullable();
            $table->integer('duration_months')->nullable();
            $table->json('features')->nullable(); // Key features/highlights
            $table->json('challenges')->nullable(); // Technical challenges solved
            $table->json('results')->nullable(); // Project outcomes/metrics
            $table->integer('views_count')->default(0);
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['is_published', 'is_featured', 'display_order']);
            $table->index(['category', 'is_published']);
            $table->index('completion_date');
            $table->index('views_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};