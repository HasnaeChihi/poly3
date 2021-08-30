<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemComparateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_comparateurs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('qte_pc')->nullable();;
            $table->integer('qte_support')->nullable();;
            $table->integer('nbr_pc')->nullable();;
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
        Schema::dropIfExists('system_comparateurs');
    }
}
