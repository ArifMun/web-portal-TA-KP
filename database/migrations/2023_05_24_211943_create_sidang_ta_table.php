<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSidangTaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sidang_ta', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('daftar_ta_id');
            $table->integer('mahasiswa_id');
            $table->string('f_bimbingan_1');
            $table->string('f_bimbingan_2');
            $table->string('slip_pembayaran');
            $table->string('catatan');
            $table->string('judul');
            $table->date('tgl_sidang');
            $table->time('jam_sidang');
            $table->enum('stts_sidang', ['proses', 'terjadwal', 'selesai']);
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
        Schema::dropIfExists('sidang_ta');
    }
}
