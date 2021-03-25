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
            $table->string('module'); 
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
            ['module'=> 'user_management', 'action'=> 'view_roles'],
            ['module'=> 'user_management', 'action'=> 'edit_roles'],
            ['module'=> 'user_management', 'action'=> 'delete_roles'],
            // ['module'=> 'user_management', 'action'=> 'delete_roles_approver'],
            ['module'=> 'user_management', 'action'=> 'assign_permissions'],
            ['module'=> 'user_management', 'action'=> 'create_users_initiator'],
            ['module'=> 'user_management', 'action'=> 'create_users_approver'],
            ['module'=> 'user_management', 'action'=> 'edit_users_initiator'],
            ['module'=> 'user_management', 'action'=> 'edit_users_approver'],
            ['module'=> 'user_management', 'action'=> 'delete_users_initiator'],
            ['module'=> 'user_management', 'action'=> 'delete_users_approver'],
            ['module'=> 'user_management', 'action'=> 'deactivate_users'],
            ['module'=> 'distributor_management', 'action'=> 'create_distributors_initiator'],
            ['module'=> 'distributor_management', 'action'=> 'create_distributors_approver'],
            ['module'=> 'distributor_management', 'action'=> 'edit_distributors_initiator'],
            ['module'=> 'distributor_management', 'action'=> 'edit_distributors_initiator'],
            ['module'=> 'distributor_management', 'action'=> 'delete_distributors_initiator'],
            ['module'=> 'distributor_management', 'action'=> 'delete_distributors_approver'],
            ['module'=> 'distributor_management', 'action'=> 'create_distributor_users'],
            ['module'=> 'distributor_management', 'action'=> 'edit_distributor_users'],
            ['module'=> 'distributor_management', 'action'=> 'delete_distributor_users'],
            ['module'=> 'distributor_management', 'action'=> 'deactivate_distributor_users'],
            ['module'=> 'field_teller_management', 'action'=> 'create_field_tellers'],
            ['module'=> 'field_teller_management', 'action'=> 'edit_field_tellers'],
            ['module'=> 'field_teller_management', 'action'=> 'delete_field_tellers'],
            ['module'=> 'field_teller_management', 'action'=> 'create_field_teller_users'],
            ['module'=> 'field_teller_management', 'action'=> 'edit_field_teller_users'],
            ['module'=> 'field_teller_management', 'action'=> 'delete_field_teller_users'],
            ['module'=> 'field_teller_management', 'action'=> 'deactivate_field_teller_users'],
            ['module'=> 'field_teller_management', 'action'=> 'assign_field_teller_merchant_branch'],
            ['module'=> 'merchant_management', 'action'=> 'create_merchants'],
            ['module'=> 'merchant_management', 'action'=> 'edit_merchants'],
            ['module'=> 'merchant_management', 'action'=> 'delete_merchants'],
            ['module'=> 'merchant_management', 'action'=> 'create_merchant_users_initiator'],
            ['module'=> 'merchant_management', 'action'=> 'create_merchant_users_approver'],
            ['module'=> 'merchant_management', 'action'=> 'edit_merchant_users'],
            ['module'=> 'merchant_management', 'action'=> 'delete_merchant_users'],
            ['module'=> 'merchant_management', 'action'=> 'deactivate_merchant_users'],
            ['module'=> 'distributor_transactions', 'action'=> 'topup_distributor_vending_accounts_initiator'],
            ['module'=> 'distributor_transactions', 'action'=> 'topup_distributor_vending_accounts_approver'],
            ['module'=> 'distributor_transactions', 'action'=> 'move_float_between_distributor_vending_accounts_initiator'],
            ['module'=> 'distributor_transactions', 'action'=> 'move_float_between_distributor_vending_accounts_approver'],
            ['module'=> 'distributor_transactions', 'action'=> 'sell_float_to_field_teller_initator'],
            ['module'=> 'distributor_transactions', 'action'=> 'sell_float_to_field_teller_approver'],
            ['module'=> 'distributor_transactions', 'action'=> 'view_distributor_own_branch_transactions'],
            ['module'=> 'distributor_transactions', 'action'=> 'view_all_distributor_branches_transactions'],
            ['module'=> 'merchant_transactions', 'action'=> 'schedule_merchant_pickup_initiator'],
            ['module'=> 'merchant_transactions', 'action'=> 'schedule_merchant_pickup_approver'],
            ['module'=> 'merchant_transactions', 'action'=> 'request_merchant_pickup_for_assigned_branch_initiator'],
            ['module'=> 'merchant_transactions', 'action'=> 'request_merchant_pickup_for_assigned_branch_approver'],
            ['module'=> 'merchant_transactions', 'action'=> 'request_merchant_pickup_for_all_branches_initiator'],
            ['module'=> 'merchant_transactions', 'action'=> 'request_merchant_pickup_for_all_branches_approver'],
            ['module'=> 'merchant_transactions', 'action'=> 'create_merchant_manual_settlement_initiator'],
            ['module'=> 'merchant_transactions', 'action'=> 'create_merchant_manual_settlement_approver'],
            ['module'=> 'merchant_transactions', 'action'=> 'view_merchant_transactions'],
            ['module'=> 'field_teller_transactions', 'action'=> 'move_float_between_field_teller_float_accounts_initiator'],
            ['module'=> 'field_teller_transactions', 'action'=> 'move_float_between_field_teller_float_accounts_approver'],
            ['module'=> 'field_teller_transactions', 'action'=> 'settle_commission_into_field_teller_float_accounts_of_choice'],
            ['module'=> 'field_teller_transactions', 'action'=> 'view_field_teller_transactions'],
            ['module'=> 'system_user_transactions', 'action'=> 'view_all_user_initiated_transactions'],
        ];
        return $data;
    }
}
