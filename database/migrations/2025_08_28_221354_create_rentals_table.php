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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tool_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('rental_date');
            $table->date('due_date');
            $table->date('return_date')->nullable();
            $table->decimal('rental_fee', 10, 2);
            $table->decimal('late_fee', 10, 2)->default(0);
            $table->decimal('total_fee', 10, 2);
            $table->enum('status', ['active', 'returned', 'overdue'])->default('active');
            $table->enum('payment_method', ['cash', 'card', 'mobile_money'])->default('cash');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
