<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasisTable extends Migration
{
    public function up()
    {
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('kamar_id');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('kamar_id')->references('id')->on('kamars');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservasis');
    }
};
