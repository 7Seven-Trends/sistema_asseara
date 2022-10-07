<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePalestrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palestras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evento_id');
            $table->string("banner")->nullable();
            $table->string("thumbnail")->nullable();
            $table->string("titulo")->nullable();
            $table->date("data")->nullable();
            $table->time("horario")->nullable();
            $table->mediumText("conteudo")->nullable();
            $table->string("palestrante", 60)->nullable();
            $table->unsignedBigInteger("visitas")->default(0);
            $table->timestamps();
            $table->foreign('evento_id')->references('id')->on('eventos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('palestras');
    }
}
