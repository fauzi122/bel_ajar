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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string("nisn", 10)->unique();
            $table->char("nis",8)->unique();
            $table->string("nama",35);
            $table->foreignId("id_kelas");
            $table->enum('jenis_kelamin',['L','P']);
            $table->text("alamat")->nullable();
            $table->string("no_telp")->nullable();
            $table->foreignId("id_spp");
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
        Schema::dropIfExists('siswas');
    }
};
