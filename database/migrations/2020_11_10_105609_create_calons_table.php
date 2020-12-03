<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calons', function (Blueprint $table) {
            $table->bigIncrements('id_calon');
            $table->integer('id_pemilu');
            $table->integer('npm');
            $table->string('nama_calon');
            $table->string('fakultas');
            $table->longText('visi');
            $table->longText('misi');
            $table->longText('proker');
            $table->integer('suara')->default(0);
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
        Schema::dropIfExists('calons');
    }
}
