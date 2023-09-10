<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_cursos', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger("posicao")->default(1);
            $table->string("caminho");
            $table->boolean("ativo");
            $table->timestamps();
            $table->string("link")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner_cursos');
    }
}
