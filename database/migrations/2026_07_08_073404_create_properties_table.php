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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();

    // Logged-in user who owns the property
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

    // Property Title
            $table->string('title', 150);

    // Property Price
            $table->decimal('price', 12, 2);

    // City
            $table->string('city', 100);

    // Full Address
            $table->text('address')->nullable();

    // Number of Bedrooms
            $table->integer('bedrooms');

    // Flat / House / Plot
            $table->string('type',50)->default('Apartment');

    // Property Image Path
            $table->string('photo', 255)->nullable();

    // 1 = Available, 0 = Sold
            $table->tinyInteger('status')->default(1);

            $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
