<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeminarKpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seminar_kp', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('mahasiswa_id');
            $table->integer('daftarkp_id');
            $table->string('form_bimbingan');
            $table->date('tgl_seminar')->nullable();
            $table->time('jam_seminar')->nullable();
            $table->string('catatan')->nullable();
            $table->string('judul');
            $table->enum('stts_seminar', ['proses', 'terjadwal', 'selesai']);
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
        Schema::dropIfExists('seminar_kp');
    }
}
