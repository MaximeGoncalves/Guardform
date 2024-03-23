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
        Schema::table('guards', function (Blueprint $table) {
            $table->text('fma1')->after('date')->nullable();
            $table->text('fma2')->after('fma1')->nullable();
            $table->text('consignes')->after('fma2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guards', function (Blueprint $table) {
            $table->dropColumn(['fma1', 'fma2', 'consignes']);
        });
    }
};
