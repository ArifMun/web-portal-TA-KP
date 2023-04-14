<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiodataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biodata', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            // $table->unsignedBigInteger('id_biodata');
            // $table->foreign('id_biodata')->references('id')->on('users');
            $table->string('nama');
            $table->integer('no_induk');
            $table->string('keahlian')->nullable();
            $table->enum('jabatan', ['dosen', 'mahasiswa', 'TU']);
            $table->string('tempat_lahir', 20)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('no_telp', 12);
            $table->text('alamat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biodata');
    }
}
