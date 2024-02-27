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
        Schema::create('govt_schemes', function (Blueprint $table) {
            $table->id();
            $table->integer('sort_col');
            $table->string('name_of_ministry');
            $table->string('name_of_departments');
            $table->string('scheme');
            $table->string('sector');
            $table->text('objective');
            $table->string('beneficaries_type');
            $table->string('grant');
            $table->string('source_of_information');
            $table->string('status');
            $table->string('remark');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('govt_schemes');   
    }
};
