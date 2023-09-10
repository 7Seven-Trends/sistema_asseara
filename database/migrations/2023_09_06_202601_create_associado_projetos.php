<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociadoProjetos extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('associado_projetos', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger("associado_id");

			$table->string("nome");
			$table->string("conteudo", 800)->nullable();

			$table->string("foto_um")->nullable();
			$table->string("foto_dois")->nullable();
			$table->string("foto_tres")->nullable();

			$table->foreign('associado_id')->references('id')->on('associados')->onDelete('cascade');
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
		Schema::dropIfExists('associado_projetos');
	}
}
