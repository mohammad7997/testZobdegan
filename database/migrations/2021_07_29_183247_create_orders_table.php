<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('totalAmount');
            $table->tinyInteger('payMethod');//0=>installment , 1=>cash
            $table->text('authority');// from zarinpal
            $table->text('userInfo')->nullable();
            $table->tinyInteger('payStatus')->default(0);//0=>not pay , 1=>pay , 2=>installment
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
