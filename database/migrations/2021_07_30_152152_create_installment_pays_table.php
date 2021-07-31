<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentPaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installment_pays', function (Blueprint $table) {
            $table->id();
            $table->integer('totalAmount');
            $table->integer('prepayment');
            $table->string('authority');
            $table->integer('installmentPay');//pay of one installment
            $table->integer('installmentNum');
            $table->string('timeOfInstallment');//time of next installment
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('installment_pays');
    }
}
