<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantCashPickupRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_cash_pickup_requests', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_reference');
            $table->decimal('transaction_amount', 10, 2);
            $table->decimal('balance_before', 10, 2);
            $table->decimal('balance_after', 10, 2);
            $table->enum('transaction_status', ['Request Pending', 'Pickup Pending', 'Completed'])->default('Request Pending');
            $table->dateTime('responded_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->enum('approval_status', ['pending', 'accepted', 'declined']);
            $table->string('decline_reason')->nullable();

            $table->bigInteger('merchant_id')->unsigned();
            $table->foreign('merchant_id')->references('id')->on('merchants');
            $table->bigInteger('field_teller_id')->unsigned()->nullable();
            $table->foreign('field_teller_id')->references('id')->on('field_tellers');
            $table->bigInteger('user_id')->unsigned()->nullable();
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
        Schema::dropIfExists('merchant_cash_pickup_requests');
    }
}
