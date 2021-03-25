<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->string('prefix');
            $table->string('business_name');
            $table->enum('type', ['parent', 'child']);
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->string('collection_account_number');
            $table->decimal('collection_account_balance', 10, 2)->nullable();
            $table->string('country');
            $table->string('region');
            $table->string('office_gps_location');
            $table->string('office_phone');
            $table->string('email');
            $table->decimal('pickup_charge', 3, 2);
            $table->decimal('field_teller_commission', 3, 2);
            $table->decimal('firm_commission', 3, 2);
            $table->boolean('is_realtime')->default(false);
            $table->string('settlement_account');
            $table->string('settlement_account_network');
            $table->string('settlement_account_number');
            $table->boolean('is_active')->default(false);
            $table->enum('approval_status', ['pending', 'accepted', 'declined']);
            $table->string('decline_reason')->nullable();

            $table->foreign('parent_id')->references('id')->on('merchants');
            $table->bigInteger('creator_id')->unsigned();
            $table->foreign('creator_id')->references('id')->on('users');
            
            $table->softDeletes();

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
        Schema::dropIfExists('merchants');
    }
}
