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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained( 
                table: 'users',
                indexName: 'payments_user_id' 
            )->onDelete('cascade');
            $table->date('payment_date');
            $table->decimal('amount');
            $table->string('month_paid');
            $table->enum('payment_status',['paid', 'pending']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'payments');
    }
};
