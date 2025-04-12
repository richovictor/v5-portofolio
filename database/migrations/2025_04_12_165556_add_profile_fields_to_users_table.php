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
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_photo_url')->nullable();
            $table->string('cover_photo_url')->nullable();
            $table->text('description')->nullable();
            $table->string('city')->nullable();
            $table->string('school_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'profile_photo_url',
                'cover_photo_url',
                'description',
                'city',
                'school_name'
            ]);
        });
    }
};
