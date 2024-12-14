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
            $table->String('username');
            $table->String('password');
            $table->String('name');
            $table->String('phone_number');
            $table->text('address');
            $table->date('birth_date');
            $table->string('image_profile')->nullable();
            $table->foreignId('class_id')->constrained( 
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
        
    }
};
