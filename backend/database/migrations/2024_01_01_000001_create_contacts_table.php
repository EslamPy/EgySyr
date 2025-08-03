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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('company')->nullable();
            $table->enum('project_type', ['web', 'mobile', 'ecommerce', 'custom']);
            $table->enum('budget', ['5k-15k', '15k-30k', '30k-50k', '50k+']);
            $table->enum('timeline', ['rush', '4-8weeks', '8-12weeks', 'flexible']);
            $table->text('message');
            $table->json('features')->nullable();
            $table->decimal('estimated_quote', 10, 2)->nullable();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->boolean('is_read')->default(false);
            $table->enum('status', ['new', 'in_progress', 'responded', 'closed', 'spam'])->default('new');
            $table->enum('priority', ['low', 'normal', 'high', 'urgent'])->default('normal');
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['status', 'created_at']);
            $table->index(['is_read', 'created_at']);
            $table->index(['priority', 'created_at']);
            $table->index('email');
            $table->index('project_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};