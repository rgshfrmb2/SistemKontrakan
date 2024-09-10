<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemesan');
            $table->integer('biaya');
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('tempat_id');
            $table->foreign('tempat_id')->references('id')->on('tempats');
            $table->unsignedBigInteger('note_id')->nullable();
            $table->date('tanggal_pembayaran')->nullable();
            $table->date('tanggal_jatuh_tempo')->nullable();
            $table->string('ruangan');
            $table->string('status');
            // Menghapus kolom catatan_id untuk menghindari duplikasi
            // $table->unsignedBigInteger('catatan_id')->nullable();

            $table->timestamps();
        });

        Schema::table('tempats', function (Blueprint $table) {
            $table->foreign('booking_id')->references('id')->on('bookings');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tempats', function (Blueprint $table) {
            $table->dropForeign(['booking_id']);
        });

        Schema::dropIfExists('bookings');
    }
}
