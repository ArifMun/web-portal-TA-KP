<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBimbinganKpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bimbing_kp', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('daftarkp_id');
            // $table->integer('dosen_id');
            // $table->integer('mahasiswa_id');
            $table->string('judul_bimbingan', 100);
            $table->string('author', 50);
            $table->string('laporan_kp');
            $table->enum('stts', ['acc', 'revisi', 'proses']);
            $table->text('catatan');
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
        Schema::dropIfExists('bimbingan_kp');
    }
}
