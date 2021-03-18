<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldTellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_tellers', function (Blueprint $table) {
            $table->id();
            $table->string('prefix');
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('type', ['parent', 'child']);
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->integer('momo_wallet_number')->nullable();
            $table->string('float_account_number')->nullable();
            $table->string('float_account_balance', 10, 2)->nullable();
            $table->string('commission_account_number');
            $table->string('commission_account_balance', 10, 2);
            $table->string('country');
            $table->string('region');
            $table->string('gps_location');
            $table->string('phone');
            $table->string('email');
            $table->decimal('cash_carrying_limit', 10, 2);
            $table->enum('float_source', ['momo', 'float']);
            $table->boolean('is_active')->default(false);

            $table->foreign('parent_id')->references('id')->on('field_tellers');
            $table->bigInteger('creator_id')->unsigned();
            $table->foreign('creator_id')->references('id')->on('users');

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
        Schema::dropIfExists('field_tellers');
    }
}
