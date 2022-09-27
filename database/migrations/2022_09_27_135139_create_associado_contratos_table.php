<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociadoContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associado_contratos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("associado_id");
            $table->date("inicio");
            $table->date("fim");
            $table->unsignedTinyInteger("nivel")->default(0);
            $table->boolean("ativo")->default(true);
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
        Schema::dropIfExists('associado_contratos');
    }
}
