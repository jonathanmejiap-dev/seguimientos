<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTitulacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titulacions', function (Blueprint $table) {
            $table->id();
            $table->string('programa');
            $table->string('anho_egreso');
            $table->enum('titulado',['si', 'no']);
            $table->string('anho_titulado')->nullable();
            $table->string('archivo')->nullable();
            $table->char('egresado_id', 8);
            $table->timestamps();

            $table->foreign('egresado_id')->references('id')->on('egresados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('titulacions');
    }
}
