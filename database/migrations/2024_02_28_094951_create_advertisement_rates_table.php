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
        Schema::create('advertisement_rates', function (Blueprint $table) {
            $table->id();
            $table->integer('sort_col');
            $table->string('advertisement_slot');
            $table->string('minimum_days');
            $table->string('per_day_rate');
            $table->string('size'); 
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisement_rates');
    }
};
