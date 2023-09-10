<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associados', function (Blueprint $table) {
            $table->id();
            $table->string("nome", 60)->nullable();
            $table->unsignedTinyInteger("modalidade")->default(0)->nullable();
            $table->string("cpf", 14)->nullable();
            $table->date("nascimento")->nullable();
            $table->string("email", 60)->nullable();
            $table->string("telefone", 16)->nullable();
            $table->string("registro_profissional", 20)->nullable();
            $table->unsignedTinyInteger("conselho_profissional")->default(0)->nullable();
            $table->unsignedTinyInteger("titulo_profissional")->nullable();
            $table->string("endereco_atendimento", 100)->nullable();
            $table->string("cidade_atendimento", 50)->nullable();
            $table->string("uf_atendimento", 2)->nullable();
            $table->string("cep_atendimento", 9)->nullable();
            $table->string("pais_atendimento", 30)->default("Brasil")->nullable();
            $table->string("foto")->nullable();

            // 0 => Em Análise
            // 1 => Aprovado
            // 2 => Reprovado
            $table->unsignedTinyInteger("situacao")->default(0);
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
        Schema::dropIfExists('associados');
    }
}
