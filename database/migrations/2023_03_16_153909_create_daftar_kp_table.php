<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarKpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_kp', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            // $table->integer('nim');
            $table->integer('mahasiswa_id');
            $table->integer('d_pembimbing_1');
            $table->integer('d_pembimbing_2');
            $table->string('judul')->nullable();
            $table->integer('pembimbing_lama')->nullable();
            $table->enum('ganti_pembimbing', ['ya', 'tidak']);
            $table->enum('stts_pengajuan', ['tertunda', 'diterima', 'ditolak']);
            $table->enum('stts_kp', ['baru', 'melanjutkan']);
            $table->integer('semester');
            $table->string('slip_pembayaran');
            $table->integer('thn_akademik_id');
            $table->string('konsentrasi');
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
        Schema::dropIfExists('daftar_kp');
    }
}
