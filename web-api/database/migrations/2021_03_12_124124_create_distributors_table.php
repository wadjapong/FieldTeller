<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributors', function (Blueprint $table) {
            $table->id();
            $table->string('prefix');
            $table->string('business_name');
            $table->enum('type', ['parent', 'child']);
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->string('vending_account_number');
            $table->decimal('vending_account_balance', 10, 2)->nullable();
            $table->string('country');
            $table->string('region');
            $table->string('office_gps_location');
            $table->integer('office_phone');
            $table->string('email');
            $table->decimal('topup_discount', 3, 2);
            $table->boolean('is_active')->default(false);
            $table->enum('approval_status', ['pending', 'accepted', 'declined']);
            $table->string('decline_reason')->nullable();

            $table->foreign('parent_id')->references('id')->on('distributors');
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
        Schema::dropIfExists('distributors');
    }
}
