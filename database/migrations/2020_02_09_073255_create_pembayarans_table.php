<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pengerjaan_id');
            $table->foreign('pengerjaan_id')->references('id')->on('pengerjaan')
                ->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->boolean('dp')->default(false);
            $table->string('jumlah_pembayaran')->nullable();
            $table->text('bukti_pembayaran');
            $table->dateTime('tgl_pembayaran');
            $table->boolean('sudah_transfer')->default(false);
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
        Schema::dropIfExists('pembayaran');
    }
}
