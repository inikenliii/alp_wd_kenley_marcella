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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained( 
                table: 'users',
                indexName: 'attendances_user_id' 
            )->onDelete('cascade');
            $table->foreignId('trainsession_id')->constrained( 
                table: 'trainsessions',
                indexName: 'attendances_trainsession_id' 
            )->onDelete('cascade');
            $table->enum('attendance_status', ['present', 'absent']);
            $table->timestamp('attendance_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'attendances');
    }
};
