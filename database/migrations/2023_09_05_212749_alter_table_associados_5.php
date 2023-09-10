<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableAssociados5 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('associados', function (Blueprint $table) {
			$table->string("whatsapp", 45)->nullable();
			$table->string("facebook", 45)->nullable();
			$table->string("instagram", 45)->nullable();
			$table->string("linkedin", 45)->nullable();
			$table->string("youtube", 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
