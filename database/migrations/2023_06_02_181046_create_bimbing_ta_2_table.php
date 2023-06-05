<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBimbingTa2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bimbing_ta_2', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('daftar_ta_id');
            // $table->integer('dosen_id');
            // $table->integer('mahasiswa_id');
            $table->string('judul_bimbingan');
            $table->string('laporan_ta');
            $table->enum('stts', ['acc', 'revisi', 'proses']);
            $table->text('catatan')->nullable();
            $table->string('author', 30);
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
        Schema::dropIfExists('bimbing_ta_2');
    }
}
