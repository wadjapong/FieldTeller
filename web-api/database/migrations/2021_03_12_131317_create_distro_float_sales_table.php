<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistroFloatSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributor_float_sales', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_reference');
            $table->decimal('transaction_amount', 10, 2);
            $table->decimal('balance_before', 10, 2);
            $table->decimal('balance_after', 10, 2);
            $table->dateTime('transaction_date');
            $table->string('transaction_status');
            $table->enum('approval_status', ['pending', 'accepted', 'declined']);
            $table->string('decline_reason')->nullable();

            $table->bigInteger('distributor_id')->unsigned();
            $table->foreign('distributor_id')->references('id')->on('distributors');
            $table->bigInteger('field_teller_id')->unsigned();
            $table->foreign('field_teller_id')->references('id')->on('field_tellers');
            $table->bigInteger('creator_id')->unsigned();
            $table->foreign('creator_id')->references('id')->on('users');
            $table->bigInteger('approver_id')->unsigned()->nullable();
            $table->foreign('approver_id')->references('id')->on('users');
            
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
        Schema::dropIfExists('distributor_float_sales');
    }
}
