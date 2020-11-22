<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemilusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemilus', function (Blueprint $table) {
            $table->bigIncrements('id_pemilu');
            $table->string('nama_pemilu');
            $table->string('kategori');
            $table->string('timeline');
            $table->integer('pin')->unique();
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
        Schema::dropIfExists('pemilus');
    }
}
