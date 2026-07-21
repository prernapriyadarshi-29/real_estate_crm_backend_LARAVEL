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
    Schema::table('properties', function (Blueprint $table) {
        $table->string('owner_type')->default('agent')->after('user_id'); // agent or user
        $table->unsignedBigInteger('owner_id')->nullable()->after('owner_type');
        $table->enum('status', ['pending', 'approved', 'rejected', 'booked', 'sold'])->default('pending')->change();
        $table->boolean('is_featured')->default(false)->after('status');
    });
}

public function down(): void
{
    Schema::table('properties', function (Blueprint $table) {
        $table->dropColumn(['owner_type', 'owner_id', 'is_featured']);
    });
}
};
