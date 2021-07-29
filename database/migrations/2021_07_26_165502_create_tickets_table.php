<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->text('property')->nullable();//serialize of property
            $table->text('description');
            $table->tinyInteger('type');
            $table->Integer('parent')->default(0);
            $table->Integer('priceCash')->nullable();//Price for cash payment
            $table->Integer('priceInstallment')->nullable();//Price for installment payment
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
        Schema::dropIfExists('tickets');
    }
}
