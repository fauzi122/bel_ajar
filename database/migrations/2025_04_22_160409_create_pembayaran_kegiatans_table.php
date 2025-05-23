<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_petugas");
            $table->string("nisn",10)->nullable();
            $table->date("tgl_bayar");
            $table->foreignId("id_kegiatan");
            $table->integer("jumlah_bayar")->nullable();
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
        Schema::dropIfExists('pembayaran_kegiatans');
    }
};
