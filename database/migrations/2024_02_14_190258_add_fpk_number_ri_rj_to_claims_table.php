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
        if (!Schema::hasColumns('claims', ['fpk_number_ri', 'fpk_number_rj', 'bast_date', 'bahv_date', 'register_boa_date', 'approve_head_date'])) {
            Schema::table('claims', function (Blueprint $table) {
                $table->string('fpk_number_ri')->nullable()->after('status');
                $table->string('fpk_number_rj')->nullable()->after('fpk_number_ri');
                $table->date('bahv_date')->nullable()->after('fpk_number_rj');
                $table->date('register_boa_date')->nullable()->after('bahv_date');
                $table->date('approve_head_date')->nullable()->after('register_boa_date');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('claims', function (Blueprint $table) {
            //
        });
    }
};
