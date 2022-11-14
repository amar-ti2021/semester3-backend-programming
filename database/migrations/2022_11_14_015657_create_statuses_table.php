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
        Schema::create('statuses', function (Blueprint $table) {

            // ID dari status, nantinya akan dihubungkan dengan tabel pasien 
            $table->id();

            // Deskripsi dari status id, Positive/Recovered/Dead
            $table->string('desc');

            // Tanggal dibuatnya data 
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
        Schema::dropIfExists('statuses');
    }
};
