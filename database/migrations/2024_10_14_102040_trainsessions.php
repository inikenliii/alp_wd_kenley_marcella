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
        Schema::create('trainsessions', callback: function (Blueprint $table): void {
            $table->id();
            $table->foreignId('class_id')
                ->constrained('classes', 'id') // Relasi ke tabel classes
                ->onDelete('cascade');        // Hapus sesi jika kelas dihapus

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