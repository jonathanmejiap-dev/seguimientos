<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentroLaboralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centro_laborals', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('sector',['publico','privado']);
            $table->string('cargo');
            $table->string('jefe_laboral')->nullable();
            $table->string('jefe_telefono')->nullable();
            $table->text('descripcion');
            $table->string('anho_labor', 4)->nullable();
            // $table->char('egresado_id', 8);
            $table->bigInteger('titulacion_id')->unsigned();
            $table->timestamps();
            // $table->foreign('egresado_id')->references('id')->on('egresados')->onDelete('cascade');
            $table->foreign('titulacion_id')->references('id')->on('titulacions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('centro_laborals');
    }
}
