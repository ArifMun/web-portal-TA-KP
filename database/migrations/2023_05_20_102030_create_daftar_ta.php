<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarTa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_ta', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('mahasiswa_id');
            $table->integer('d_pembimbing_1');
            $table->integer('d_pembimbing_2');
            $table->string('judul', 100)->nullable();
            $table->integer('pembimbing_lama_1')->nullable();
            $table->integer('pembimbing_lama_2')->nullable();
            $table->enum('stts_pengajuan', ['tertunda', 'diterima', 'ditolak']);
            $table->enum('stts_ta', ['baru', 'melanjutkan']);
            $table->string('krs');
            $table->integer('thn_akademik_id');
            $table->integer('konsentrasi');
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
        Schema::dropIfExists('daftar_ta');
    }
}
