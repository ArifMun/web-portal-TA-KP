<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengumumanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();
            $table->text('cttn_daftar_kp')->nullable();
            $table->text('cttn_bimbingan_kp')->nullable();
            $table->text('cttn_seminar_kp')->nullable();
            $table->text('cttn_daftar_ta')->nullable();
            $table->text('cttn_bimbingan_ta')->nullable();
            $table->text('cttn_sidang_ta')->nullable();
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
        Schema::dropIfExists('pengumuman');
    }
}
