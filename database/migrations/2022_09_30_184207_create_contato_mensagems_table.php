<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContatoMensagemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contato_mensagems', function (Blueprint $table) {
            $table->id();
            $table->string("nome", 60)->nullable();
            $table->string("telefone", 16)->nullable();
            $table->string("email", 60)->nullable();
            $table->string("cidade", 30)->nullable();
            $table->string("mensagem", 400)->nullable();
            $table->boolean("visualizada")->default(false);
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
        Schema::dropIfExists('contato_mensagems');
    }
}
