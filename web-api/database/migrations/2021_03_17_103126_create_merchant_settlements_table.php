<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_settlements', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_reference');
            $table->decimal('transaction_amount', 10, 2);
            $table->decimal('balance_before', 10, 2);
            $table->decimal('balance_after', 10, 2);
            $table->dateTime('transaction_date');
            $table->string('transaction_status');
            $table->enum('approval_status', ['pending', 'accepted', 'declined']);
            $table->string('decline_reason')->nullable();

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
        Schema::dropIfExists('merchant_settlements');
    }
}
