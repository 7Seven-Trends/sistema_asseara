<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociadoHotsite extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('associado_hotsites', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger("associado_id");
			$table->string("topbar", 40)->nullable();

			$table->string("logo")->nullable();
			$table->string("cover_video")->nullable();
			$table->string("video")->nullable();

			$table->text("apresentacao")->nullable();
			$table->text("formacao")->nullable();

			$table->boolean("esconder_servicos")->default(false);

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
		Schema::dropIfExists('associado_hotsites');
	}
}
