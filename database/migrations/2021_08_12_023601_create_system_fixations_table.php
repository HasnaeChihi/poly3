<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemFixationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_fixations', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('str_type')->nullable();
            $table->integer('str_qte')->nullable();
            $table->string('support_str_type')->nullable();
            $table->integer('support_str_qte')->nullable();
            $table->integer('clip_qte')->nullable();
            $table->integer('bridage_qte')->nullable();
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
        Schema::dropIfExists('system_fixations');
    }
}
