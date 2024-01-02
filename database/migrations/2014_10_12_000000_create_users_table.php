<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('name');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('telegram_chat_id')->nullable();
            $table->date('email_verified_at');
            $table->enum('role', ['FINANCE', 'VERIFICATOR', 'ADMIN', 'HEAD']);
            $table->string('password');
            $table->string('remember_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
