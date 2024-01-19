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
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignUuid('hospital_uuid')->nullable()->constrained('hospitals', 'uuid');
            $table->string('unit_name');
            $table->string('archive_number')->nullable();
            $table->string('dos_number');
            $table->string('archive_title');
            $table->string('classification_code');
            $table->string('hospital_name');
            $table->string('month');
            $table->integer('year');
            $table->string('file_content_information');
            $table->string('description', 30)->nullable();
            $table->enum('status', ['AKTIF', 'INAKTIF'])->default('AKTIF');
            $table->integer('active_retention_schedule')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archives');
    }
};
