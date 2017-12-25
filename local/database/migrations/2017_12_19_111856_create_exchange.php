<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExchange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('exchange', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codeexchange');
            $table->integer('userid_a');
            $table->string('address_a');
            $table->string('phone_a');
            $table->string('bank_a');
            $table->string('accountbank_a');
            $table->string('coin');
            $table->integer('intermediate_id');
            $table->integer('userid_b');
            $table->string('address_b');
            $table->string('phone_b');
            $table->string('bank_b');
            $table->string('accountbank_b');
            $table->string('step');
            $table->rememberToken();
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
        //
    }
}
