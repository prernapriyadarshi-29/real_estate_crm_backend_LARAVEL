<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->foreignId('customer_id')->after('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('property_id')->after('customer_id')->constrained()->onDelete('cascade');
            $table->date('follow_up_date')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropForeignIdFor('customer_id');
            $table->dropForeignIdFor('property_id');
            $table->dropColumn(['customer_id', 'property_id', 'follow_up_date']);
        });
    }
};