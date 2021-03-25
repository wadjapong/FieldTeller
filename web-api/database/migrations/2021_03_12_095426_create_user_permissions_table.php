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
            $table->string('user_type'); 
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
            ['user_type'=> 'all_users', 'module'=> 'user_management', 'action'=> 'view_roles'],
            ['user_type'=> 'all_users', 'module'=> 'user_management', 'action'=> 'create_roles_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'user_management', 'action'=> 'create_roles_approver'],
            ['user_type'=> 'all_users', 'module'=> 'user_management', 'action'=> 'edit_roles_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'user_management', 'action'=> 'delete_roles_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'user_management', 'action'=> 'delete_roles_approver'],
            ['user_type'=> 'all_users', 'module'=> 'user_management', 'action'=> 'assign_permissions_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'user_management', 'action'=> 'assign_permissions_approver'],
            ['user_type'=> 'all_users', 'module'=> 'user_management', 'action'=> 'create_users_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'user_management', 'action'=> 'create_users_approver'],
            ['user_type'=> 'all_users', 'module'=> 'user_management', 'action'=> 'edit_users_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'user_management', 'action'=> 'edit_users_approver'],
            ['user_type'=> 'all_users', 'module'=> 'user_management', 'action'=> 'delete_users_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'user_management', 'action'=> 'delete_users_approver'],
            ['user_type'=> 'all_users', 'module'=> 'user_management', 'action'=> 'deactivate_users'],
            ['user_type'=> 'all_users', 'module'=> 'distributor_management', 'action'=> 'create_distributors_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'distributor_management', 'action'=> 'create_distributors_approver'],
            ['user_type'=> 'all_users', 'module'=> 'distributor_management', 'action'=> 'edit_distributors_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'distributor_management', 'action'=> 'edit_distributors_approver'],
            ['user_type'=> 'all_users', 'module'=> 'distributor_management', 'action'=> 'delete_distributors_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'distributor_management', 'action'=> 'delete_distributors_approver'],
            ['user_type'=> 'all_users', 'module'=> 'distributor_management', 'action'=> 'create_distributor_users_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'distributor_management', 'action'=> 'create_distributor_users_approver'],
            ['user_type'=> 'all_users', 'module'=> 'distributor_management', 'action'=> 'edit_distributor_users_initator'],
            ['user_type'=> 'all_users', 'module'=> 'distributor_management', 'action'=> 'edit_distributor_users_approver'],
            ['user_type'=> 'all_users', 'module'=> 'distributor_management', 'action'=> 'delete_distributor_users_initator'],
            ['user_type'=> 'all_users', 'module'=> 'distributor_management', 'action'=> 'delete_distributor_users_approver'],
            ['user_type'=> 'all_users', 'module'=> 'distributor_management', 'action'=> 'deactivate_distributor_users'],
            ['user_type'=> 'all_users', 'module'=> 'field_teller_management', 'action'=> 'create_field_tellers_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'field_teller_management', 'action'=> 'create_field_tellers_approver'],
            ['user_type'=> 'all_users', 'module'=> 'field_teller_management', 'action'=> 'edit_field_tellers_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'field_teller_management', 'action'=> 'edit_field_tellers_approver'],
            ['user_type'=> 'all_users', 'module'=> 'field_teller_management', 'action'=> 'delete_field_tellers_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'field_teller_management', 'action'=> 'delete_field_tellers_approver'],
            ['user_type'=> 'all_users', 'module'=> 'field_teller_management', 'action'=> 'create_field_teller_users_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'field_teller_management', 'action'=> 'create_field_teller_users_approver'],
            ['user_type'=> 'all_users', 'module'=> 'field_teller_management', 'action'=> 'edit_field_teller_users_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'field_teller_management', 'action'=> 'edit_field_teller_users_approver'],
            ['user_type'=> 'all_users', 'module'=> 'field_teller_management', 'action'=> 'delete_field_teller_users_initator'],
            ['user_type'=> 'all_users', 'module'=> 'field_teller_management', 'action'=> 'delete_field_teller_users_approver'],
            ['user_type'=> 'all_users', 'module'=> 'field_teller_management', 'action'=> 'deactivate_field_teller_users'],
            ['user_type'=> 'all_users', 'module'=> 'field_teller_management', 'action'=> 'assign_field_teller_merchant_branch_initator'],
            ['user_type'=> 'all_users', 'module'=> 'field_teller_management', 'action'=> 'assign_field_teller_merchant_branch_approver'],
            ['user_type'=> 'all_users', 'module'=> 'merchant_management', 'action'=> 'create_merchants_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'merchant_management', 'action'=> 'create_merchants_approver'],
            ['user_type'=> 'all_users', 'module'=> 'merchant_management', 'action'=> 'edit_merchants_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'merchant_management', 'action'=> 'edit_merchants_approver'],
            ['user_type'=> 'all_users', 'module'=> 'merchant_management', 'action'=> 'delete_merchants_initator'],
            ['user_type'=> 'all_users', 'module'=> 'merchant_management', 'action'=> 'delete_merchants_approver'],
            ['user_type'=> 'all_users', 'module'=> 'merchant_management', 'action'=> 'create_merchant_users_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'merchant_management', 'action'=> 'create_merchant_users_approver'],
            ['user_type'=> 'all_users', 'module'=> 'merchant_management', 'action'=> 'edit_merchant_users_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'merchant_management', 'action'=> 'edit_merchant_users_approver'],
            ['user_type'=> 'all_users', 'module'=> 'merchant_management', 'action'=> 'delete_merchant_users_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'merchant_management', 'action'=> 'delete_merchant_users_approver'],
            ['user_type'=> 'all_users', 'module'=> 'merchant_management', 'action'=> 'deactivate_merchant_users'],
            ['user_type'=> 'all_users', 'module'=> 'distributor_transactions', 'action'=> 'topup_distributor_vending_accounts_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'distributor_transactions', 'action'=> 'topup_distributor_vending_accounts_approver'],
            ['user_type'=> 'all_users', 'module'=> 'distributor_transactions', 'action'=> 'move_float_between_distributor_vending_accounts_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'distributor_transactions', 'action'=> 'move_float_between_distributor_vending_accounts_approver'],
            ['user_type'=> 'all_users', 'module'=> 'distributor_transactions', 'action'=> 'sell_float_to_field_teller_initator'],
            ['user_type'=> 'all_users', 'module'=> 'distributor_transactions', 'action'=> 'sell_float_to_field_teller_approver'],
            ['user_type'=> 'all_users', 'module'=> 'distributor_transactions', 'action'=> 'view_distributor_own_branch_transactions'],
            ['user_type'=> 'all_users', 'module'=> 'distributor_transactions', 'action'=> 'view_all_distributor_branches_transactions'],
            ['user_type'=> 'all_users', 'module'=> 'merchant_transactions', 'action'=> 'schedule_merchant_pickup_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'merchant_transactions', 'action'=> 'schedule_merchant_pickup_approver'],
            ['user_type'=> 'merchant', 'module'=> 'merchant_transactions', 'action'=> 'schedule_merchant_pickup_for_all_merchant_branches_initiator'],
            ['user_type'=> 'merchant', 'module'=> 'merchant_transactions', 'action'=> 'schedule_merchant_pickup_for_all_merchant_branches_approver'],
            ['user_type'=> 'merchant', 'module'=> 'merchant_transactions', 'action'=> 'request_merchant_pickup_for_assigned_branch_initiator'],
            ['user_type'=> 'merchant', 'module'=> 'merchant_transactions', 'action'=> 'request_merchant_pickup_for_assigned_branch_approver'],
            ['user_type'=> 'merchant', 'module'=> 'merchant_transactions', 'action'=> 'request_merchant_pickup_for_all_merchant_branches_initiator'],
            ['user_type'=> 'merchant', 'module'=> 'merchant_transactions', 'action'=> 'request_merchant_pickup_for_all_merchant_branches_approver'],
            ['user_type'=> 'merchant', 'module'=> 'merchant_transactions', 'action'=> 'initiate_cash_pickup_for_own_branch_initiator'],
            ['user_type'=> 'merchant', 'module'=> 'merchant_transactions', 'action'=> 'initiate_cash_pickup_for_own_branch_approver'],
            ['user_type'=> 'all_users', 'module'=> 'merchant_transactions', 'action'=> 'create_merchant_manual_settlement_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'merchant_transactions', 'action'=> 'create_merchant_manual_settlement_approver'],
            ['user_type'=> 'all_users', 'module'=> 'merchant_transactions', 'action'=> 'view_merchant_transactions'],
            ['user_type'=> 'all_users', 'module'=> 'field_teller_transactions', 'action'=> 'move_float_between_field_teller_float_accounts_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'field_teller_transactions', 'action'=> 'move_float_between_field_teller_float_accounts_approver'],
            ['user_type'=> 'all_users', 'module'=> 'field_teller_transactions', 'action'=> 'settle_commission_into_field_teller_float_accounts_of_choice_initiator'],
            ['user_type'=> 'all_users', 'module'=> 'field_teller_transactions', 'action'=> 'settle_commission_into_field_teller_float_accounts_of_choice_approver'],
            ['user_type'=> 'all_users', 'module'=> 'field_teller_transactions', 'action'=> 'view_field_teller_transactions'],
            ['user_type'=> 'all_users', 'module'=> 'system_user_transactions', 'action'=> 'view_all_user_initiated_transactions'],
        ];
        return $data;
    }
}
