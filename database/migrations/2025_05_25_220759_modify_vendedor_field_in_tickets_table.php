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
            // Por si ya agregaste el vendedor_id
            if (Schema::hasColumn('tickets', 'vendedor_id')) {
                $table->dropForeign(['vendedor_id']);
                $table->dropColumn('vendedor_id');
            }

            $table->string('vendedor')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('vendedor');
            // No volvemos a agregar el vendedor_id ya que decidiste no usarlo
        });
    }
};
