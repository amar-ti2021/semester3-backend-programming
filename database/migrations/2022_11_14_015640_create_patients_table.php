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
        Schema::create('patients', function (Blueprint $table) {

            // ID Pasien
            $table->id();

            // Nama Pasien
            $table->string('name');

            // Nomor Telepon Pasien 
            $table->string('phone');

            // Alamat Pasien 
            $table->text('address');

            // Status pasien, foreign key dari table statuses 
            // 0 = positive, 1 = recovered, 2 = dead
            $table->foreignId('status_id');

            // Tanggal pasien terkonfirmasi Covid 
            $table->date('in_date_at');

            // Tanggal pasien sembuh atau meninggal, null jika pasien masih dirawat
            $table->date('out_date_at')->nullable();

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
        Schema::dropIfExists('patients');
    }
};
