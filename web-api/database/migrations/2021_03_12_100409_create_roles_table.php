<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('user_type');
            $table->string('name');
            $table->enum('approval_status', ['pending', 'accepted', 'declined'])->default('pending');
            $table->string('decline_reason')->nullable();
            $table->bigInteger('creator_id')->unsigned();
            $table->bigInteger('approver_id')->unsigned()->nullable();
            $table->timestamps();
        });

        $data = $this->getData();
        \DB::table('roles')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }

    public function getData() {
        $data = [
            ['user_type'=> 'system_user', 'name'=> 'super admin', 'approval_status'=> 'accepted', 'creator_id'=> '1', 'created_at'=> date('Y-m-d H:i:s')],
        ];
        return $data;
    }
}
