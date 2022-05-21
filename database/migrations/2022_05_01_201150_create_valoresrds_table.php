<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valoresrds', function (Blueprint $table) {
            $table->id();
            $table->decimal('valor',5,2);
            $table->text('descricao');
            $table->foreignId('tipo')->references('id_tipo')->on('tipos');
            $table->foreignId('banco')->references('id_banco')->on('bancos');
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
        Schema::dropIfExists('valoresrds');
    }
};
