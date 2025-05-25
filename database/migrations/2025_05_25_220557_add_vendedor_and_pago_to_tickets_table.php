<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('vendedor_id')->nullable()->after('status');
            $table->decimal('monto_pagado', 8, 2)->nullable()->after('vendedor_id');

            $table->foreign('vendedor_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['vendedor_id']);
            $table->dropColumn(['vendedor_id', 'monto_pagado']);
        });
    }
};
