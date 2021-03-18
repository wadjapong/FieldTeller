<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistroAcctTopupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributor_acct_topups', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_reference');
            $table->decimal('total_amount', 10, 2);
            $table->decimal('balance_before', 10, 2);
            $table->decimal('balance_after', 10, 2);
            $table->decimal('transaction_amount', 10, 2);
            $table->dateTime('transaction_date');
            $table->string('transaction_status');

            $table->bigInteger('distributor_id')->unsigned();
            $table->foreign('distributor_id')->references('id')->on('distributors');
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
        Schema::dropIfExists('distributor_acct_topups');
    }
}
