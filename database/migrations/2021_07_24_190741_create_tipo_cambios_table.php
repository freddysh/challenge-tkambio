<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoCambiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_cambios', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable(false)->comment('fecha del tipo de cambio');
            $table->decimal('tc_venta',4,3)->default(0)->comment('precio de la venta en soles del tipo de cambio');
            $table->decimal('tc_compra',4,3)->default(0)->comment('precio de la compra en soles del tipo de cambio');
            $table->softDeletes()->comment('campo para el softDelete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_cambios');
    }
}
