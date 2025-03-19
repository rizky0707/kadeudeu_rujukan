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
        Schema::table('rujukans', function (Blueprint $table) {
            $table->string('approved_by')->nullable(); // Comma-separated user IDs
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rujukans', function (Blueprint $table) {
            $table->dropColumn('approved_by');
        });
    }
};
