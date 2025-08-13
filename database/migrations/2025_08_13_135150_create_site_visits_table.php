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
        Schema::create('site_visits', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address');
            $table->string('user_agent')->nullable();
            $table->string('country')->nullable();
            $table->string('country_code', 2)->nullable();
            $table->string('city')->nullable();
            $table->string('page_url');
            $table->string('referrer')->nullable();
            $table->integer('session_duration')->default(0); // in seconds
            $table->boolean('is_unique_visitor')->default(false);
            $table->string('visitor_id')->nullable(); // for tracking unique visitors
            $table->timestamps();

            $table->index(['created_at', 'country_code']);
            $table->index('visitor_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_visits');
    }
};
