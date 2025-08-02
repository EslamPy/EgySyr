<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


// this is all the funcitons of the migrations and it will be used for the users in the database and it will be useful of it try to make it as hard as you can

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::hasTable('contacts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        // Schema::table(')create('contacts', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
