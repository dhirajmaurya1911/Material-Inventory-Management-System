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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();

            // Category ID is connected with categories table
            // Relationship is handled through Eloquent Model
            $table->unsignedBigInteger('category_id');

            // Material name
            $table->string('name');

            // Opening balance with maximum 2 decimal places
            $table->decimal('opening_balance', 15, 2);

            // Soft delete column
            $table->softDeletes();

            // created_at and updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};