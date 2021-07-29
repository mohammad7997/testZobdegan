<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installment_features', function (Blueprint $table) {
            $table->id();
            $table->integer('installmentNum');//number of installment
            $table->integer('installmentTime');// time of installment for pay
            $table->integer('prepayment');
            $table->foreignId('ticket_id')->constrained()->onDelete('cascade');// time of installment for pay
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
        Schema::dropIfExists('installment_features');
    }
}
