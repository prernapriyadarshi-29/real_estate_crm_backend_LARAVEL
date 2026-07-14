<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('leads', 'notes') && !Schema::hasColumn('leads', 'note')) {
            Schema::table('leads', function (Blueprint $table) {
                $table->renameColumn('notes', 'note');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('leads', 'note')) {
            Schema::table('leads', function (Blueprint $table) {
                $table->renameColumn('note', 'notes');
            });
        }
    }
};