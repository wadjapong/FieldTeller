<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('action'); 
            $table->timestamps();
        });

        $data = $this->getData();
        \DB::table('user_permissions')->insert($data);
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_permissions');
    }

    public function getData() {
        $data = [
            ['action'=> 'view_roles'],
            ['action'=> 'edit_roles'],
            ['action'=> 'delete_roles'],
            ['action'=> 'create_permissions'],
            ['action'=> 'edit_permissions'],
            ['action'=> 'create_users'],
            ['action'=> 'edit_users'],
            ['action'=> 'delete_users'],
            ['action'=> 'create_distributors'],
            ['action'=> 'edit_distributors'],
            ['action'=> 'delete_distributors'],
            ['action'=> 'create_distributor_users'],
            ['action'=> 'edit_distributor_users'],
            ['action'=> 'delete_distributor_users'],
            ['action'=> 'assign_distributor_permissions'],
            ['action'=> 'create_field_tellers'],
            ['action'=> 'edit_field_tellers'],
            ['action'=> 'delete_field_tellers'],
            ['action'=> 'create_field_teller_users'],
            ['action'=> 'edit_field_teller_users'],
            ['action'=> 'delete_field_teller_users'],
            ['action'=> 'assign_field_teller_permissions'],
            ['action'=> 'assign_field_teller_merchant_branch'],
            ['action'=> 'create_merchants'],
            ['action'=> 'edit_merchants'],
            ['action'=> 'delete_merchants'],
            ['action'=> 'create_merchant_users'],
            ['action'=> 'edit_merchant_users'],
            ['action'=> 'delete_merchant_users'],
            ['action'=> 'assign_merchant_permissions'],
            ['action'=> 'topup_distributor_vending_accounts_initiator'],
            ['action'=> 'topup_distributor_vending_accounts_approver'],
            ['action'=> 'move_float_between_distributor_vending_accounts_initiator'],
            ['action'=> 'move_float_between_distributor_vending_accounts_approver'],
            ['action'=> 'sell_float_to_field_teller_initator'],
            ['action'=> 'sell_float_to_field_teller_approver'],
            ['action'=> 'view_distributor_own_branch_transactions'],
            ['action'=> 'view_all_distributor_branches_transactions'],
            ['action'=> 'schedule_merchant_pickup'],
            ['action'=> 'request_merchant_pickup'],
            ['action'=> 'request_merchant_pickup_for_assigned_branch'],
            ['action'=> 'request_merchant_pickup_for_all_branches'],
            ['action'=> 'create_merchant_manual_settlement'],
            ['action'=> 'view_merchant_transactions'],
            ['action'=> 'move_float_between_field_teller_float_accounts_initiator'],
            ['action'=> 'move_float_between_field_teller_float_accounts_approver'],
            ['action'=> 'settle_commission_into_field_teller_float_accounts_of_choice'],
            ['action'=> 'view_field_teller_transactions'],
            ['action'=> 'view_all_transactions'],
        ];
        return $data;
    }
}
