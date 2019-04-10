<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSingkapanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('singkapan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('input_id');
            $table->string('singkapan_kode');
            $table->string('singkapan_nama_batuan');
            $table->string('singkapan_jenis_batuan');
            $table->string('singkapan_lat');
            $table->string('singkapan_lng');
            $table->string('singkapan_elevasi');
            $table->string('singkapan_attach');
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
        Schema::dropIfExists('singkapan');
    }
}
