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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_title')->nullable();
            $table->string('client_company');
            $table->string('client_email')->nullable();
            $table->string('client_image')->nullable();
            $table->text('content');
            $table->integer('rating')->default(5); // 1-5 star rating
            $table->string('project_type')->nullable();
            $table->decimal('project_value', 10, 2)->nullable();
            $table->date('project_completion_date')->nullable();
            $table->boolean('is_published')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->integer('display_order')->default(0);
            $table->json('tags')->nullable(); // For categorization
            $table->string('video_url')->nullable(); // For video testimonials
            $table->text('admin_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['is_published', 'display_order']);
            $table->index(['is_featured', 'created_at']);
            $table->index('rating');
            $table->index('project_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};