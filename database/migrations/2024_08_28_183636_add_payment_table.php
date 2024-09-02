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
        //
        Schema::table('shipment_tbl', function (Blueprint $table) {
            $table->string('mode_of_payment')->after('total_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('shipment_tbl', function (Blueprint $table) {
            $table->dropColumn('mode_of_payment');
        });
    }
};
