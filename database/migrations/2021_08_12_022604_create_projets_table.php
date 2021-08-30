<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('famille_id');
            $table->integer('ngo_id');
            $table->integer('comparateur_id');
            $table->integer('fixation_id');
            $table->integer('iso_statisme_id');
            $table->integer('cout_mdc_id');
            $table->string('nom');
            $table->string('client');
            $table->string('client_final')->nullable();
            $table->string('id_designation');
            $table->integer('nbr_mdc');
            $table->string('type_mdc');
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
        Schema::dropIfExists('projets');
    }
}
