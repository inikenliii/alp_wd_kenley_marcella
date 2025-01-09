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
        Schema::create('trainsessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained( 
                table: 'classes',
                indexName: 'trainsessions_class_id' 
<<<<<<< HEAD:database/migrations/2024_10_14_102040_trainsessions.php
            );
=======
            )->onDelete('cascade');
            $table->foreignId('user_id')->constrained( 
                table: 'users',
                indexName: 'trainsessions_user_id' 
            )->onDelete('cascade');
>>>>>>> d71fd21c30b61d35e80ec46bd532d788674ee4d9:database/migrations/2024_12_14_102040_trainsessions.php
            $table->string('image');
            $table->date('trainsession_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainsessions');
    }

};