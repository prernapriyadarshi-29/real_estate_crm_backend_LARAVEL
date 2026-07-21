<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_visits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id')->nullable();
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('agent_id');
            $table->dateTime('visit_date');
            $table->enum('status', ['scheduled', 'completed', 'cancelled'])->default('scheduled');
            $table->text('feedback')->nullable();
            $table->timestamps();
            
            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('set null');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['property_id', 'agent_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_visits');
    }
};