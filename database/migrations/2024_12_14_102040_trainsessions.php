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
            );
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
