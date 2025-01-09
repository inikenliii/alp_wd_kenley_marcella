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
        Schema::create('train_session_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainsession_id')->constrained( 
                table: 'trainsessions',
                indexName: 'trainsessions_user_trainsession_id' 
            );
            $table->foreignId('user_id')->constrained( 
                table: 'users',
                indexName: 'trainsessions_user_user_id' 
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('train_session_user');
    }
};
