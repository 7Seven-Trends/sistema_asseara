<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string("banner")->nullable();
            $table->string("thumbnail")->nullable();
            $table->string("titulo")->nullable();
            $table->string("local")->nullable();
            $table->string("tema")->nullable();
            $table->string("data")->nullable();
            $table->mediumText("conteudo")->nullable();
            $table->unsignedBigInteger("visitas")->default(0);
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
        Schema::dropIfExists('eventos');
    }
}
