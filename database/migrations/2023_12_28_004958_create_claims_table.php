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
        Schema::create('claims', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('hospital_name');
            $table->enum('level', ['FKRTL', 'FKTP'])->default('FKRTL');
            $table->string('claim_type');
            $table->string('month');
            $table->date('created_date');
            $table->date('ba_date');
            $table->date('completion_limit_date');
            $table->date('file_completeness')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
