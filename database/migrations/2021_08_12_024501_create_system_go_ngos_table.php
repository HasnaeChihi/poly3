<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemGoNgosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_go_ngos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('qte_bm')->nullable();;
            $table->integer('support_bm')->nullable();;
            $table->integer('nbr_bm')->nullable();;
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
        Schema::dropIfExists('system_go_ngos');
    }
}
