<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientPairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_pairs', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(false);

            $table->bigInteger('field_teller_id')->unsigned();
            $table->foreign('field_teller_id')->references('id')->on('field_tellers');
            $table->bigInteger('merchant_id')->unsigned();
            $table->foreign('merchant_id')->references('id')->on('merchants');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
                     
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
        Schema::dropIfExists('client_pairs');
    }
}
