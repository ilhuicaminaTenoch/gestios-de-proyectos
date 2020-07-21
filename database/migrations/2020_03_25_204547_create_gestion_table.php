<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('gestion', function (Blueprint $table) {
            $table->Increments('id_gestion');
            $table->integer('id_contratista');
            $table->datetime('induccion');
            $table->datetime('examen_medico');
            $table->datetime('alturas');
            $table->datetime('armado_a');
            $table->datetime('plataforma_e');
            $table->datetime('gruas_i');
            $table->datetime('montacargas');
            $table->datetime('equipo_aux');
            $table->datetime('maquinaria_p');
            $table->datetime('e_confinados');
            $table->datetime('t_caliente');
            $table->datetime('t_electricos');
            $table->datetime('loto');
            $table->datetime('apertura_l');
            $table->datetime('amoniaco');
            $table->datetime('quimicos');
            $table->datetime('temperatura_e');
            $table->datetime('temperatura_a');
            
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
        Schema::dropIfExists('gestion');
    }
}
