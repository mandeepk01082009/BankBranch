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
        Schema::create('csr_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('sort_col');
            $table->integer("department_id");
            $table->integer('csr_category_id');
            $table->text('details');
            $table->string('estimated_expense');
            $table->boolean('is_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('csr_requests');
    }
};
