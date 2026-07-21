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
    Schema::create('agents', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('phone')->nullable();
        $table->text('address')->nullable();
        $table->integer('years_of_experience')->default(0);
        $table->string('aadhaar_url')->nullable();
        $table->string('pan_url')->nullable();
        $table->string('license_url')->nullable();
        $table->boolean('bank_account_verified')->default(false);
        $table->enum('kyc_status', ['pending', 'verified', 'rejected'])->default('pending');
        $table->enum('approval_status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('agents');
}
};
