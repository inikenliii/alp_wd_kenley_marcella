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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password')->unique();
            $table->string('name');
            $table->string('phone_number');
            $table->string('address');
            $table->date('birth_date');
            $table->string('image_profile')->nullable();
            $table->boolean('isAdmin')->default(false);
            $table->foreignId('class_id')->nullable()->constrained(
                table: 'classes',
                indexName: 'users_class_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
