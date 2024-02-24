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
        Schema::create('guards', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique();
            $table->timestamps();
        });

        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guard_id')->constrained()->onDelete('cascade');
            $table->boolean('is_night')->default(false);

            $table->foreignId('ca_vsav1')->nullable();
            $table->foreignId('cond_vsav1')->nullable();
            $table->foreignId('eq_vsav1')->nullable();

            $table->foreignId('ca_vsav2')->nullable();
            $table->foreignId('cond_vsav2')->nullable();
            $table->foreignId('eq_vsav2')->nullable();

            $table->foreignId('ca_vsav3')->nullable();
            $table->foreignId('cond_vsav3')->nullable();
            $table->foreignId('eq_vsav3')->nullable();

            $table->foreignId('ca_vtu')->nullable();
            $table->foreignId('cond_vtu')->nullable();
            $table->foreignId('eq_vtu')->nullable();

            $table->foreignId('ca_vsr')->nullable();
            $table->foreignId('cond_vsr')->nullable();
            $table->foreignId('eq_vsr')->nullable();

            $table->foreignId('ca_fptl')->nullable();
            $table->foreignId('cond_fptl')->nullable();
            $table->foreignId('ce1_fptl')->nullable();
            $table->foreignId('ce2_fptl')->nullable();
            $table->foreignId('eq1_fptl')->nullable();
            $table->foreignId('eq2_fptl')->nullable();

            $table->foreignId('vli')->nullable();
            $table->foreignId('epa')->nullable();

            $table->timestamps();
        });

        Schema::create('agent_form', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained()->onDelete('cascade');
            $table->foreignId('agent_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
