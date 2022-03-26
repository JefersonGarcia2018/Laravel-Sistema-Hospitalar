<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelatoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relatorios', function (Blueprint $table) {
            $table->id();
            $table->string('id_funcionario', 11);
            $table->string('id_paciente', 11);
            $table->string('pa', 7)->nullable();
            $table->string('fc', 3)->nullable();
            $table->string('temperatura', 4)->nullable();
            $table->string('sat', 3)->nullable();
            $table->string('resp', 2)->nullable();
            $table->text('relatorio')->nullable();
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
        Schema::dropIfExists('relatorios');
    }
}
