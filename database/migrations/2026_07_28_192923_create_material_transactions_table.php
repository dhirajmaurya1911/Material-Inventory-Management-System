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
        Schema::create('material_transactions', function (Blueprint $table) {
            $table->id();

            // Material ID used for Eloquent relationship
            $table->unsignedBigInteger('material_id');

            // Inward / outward transaction date
            $table->date('transaction_date');

            // Positive = Inward
            // Negative = Outward
            $table->decimal('quantity', 15, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_transactions');
    }
};