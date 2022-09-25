<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociadoDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associado_documentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("associado_id");
            $table->string("descricao", 100);
            // 99 => Outros
            $table->unsignedTinyInteger("tipo")->default(99);
            $table->string("caminho");
            // 0 => Em Análise
            // 1 => Aprovado
            // -1 => Reprovado
            $table->unsignedTinyInteger("status")->default(0);
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
        Schema::dropIfExists('associado_documentos');
    }
}
