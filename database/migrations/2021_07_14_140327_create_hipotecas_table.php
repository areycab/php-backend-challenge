<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHipotecasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hipotecas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ahorros_aportados')->unsigned();
            $table->integer('precio_compra')->unsigned();
            $table->smallInteger('porcentaje');
            $table->unsignedBigInteger('experto_id');
            $table->unsignedBigInteger('cliente_id');
            $table->timestamps();

//            CLAVES FORÁNEAS
            $table->foreign('experto_id')->references('id')->on('expertos')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hipotecas');
    }
}
