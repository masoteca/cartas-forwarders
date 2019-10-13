<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('awb', 100)->unique();
            $table->unsignedBigInteger('id_destination');
            $table->string('iata_code', 100);
            $table->date('fecha_envio');
            $table->unsignedBigInteger('id_product');
            $table->unsignedBigInteger('id_airline');
            $table->string('rut_encargado', 20);

            $table->foreign('id_destination')->references('id')->on('destinations');
            $table->foreign('id_product')->references('id')->on('products');
            $table->foreign('id_airline')->references('id')->on('airlines');
            $table->foreign('rut_encargado')->references('rut')->on('encargados');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
