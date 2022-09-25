<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('noticia_id');
            $table->string('ip', 20)->nullable();
            $table->string('estado', 2)->nullable();
            $table->string('cidade', 30)->nullable();
            $table->string('cep', 10)->nullable();
            $table->timestamps();
            $table->foreign('noticia_id')->references('id')->on('noticias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitas');
    }
}
