<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);   
			$table->string('label')->nullable();  			
            $table->timestamps();
        });
		Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);   
			$table->string('label')->nullable();  			
            $table->timestamps();
        });
		Schema::create('permission_role', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('permission_id')->unsigned();
           
		    $table->foreign('role_id')
					->references('id')
					->on('roles');
					
			$table->foreign('permission_id')
					->references('id')
					->on('permissions');
			
			$table->primary(['role_id', 'permission_id']);
					
        });
		
		Schema::create('role_user', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('user_id')->unsigned();
           
		    $table->foreign('role_id')
					->references('id')
					->on('roles');
					
			$table->foreign('user_id')
					->references('id')
					->on('users');
			
			$table->primary(['role_id', 'user_id']);
					
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('roles');
		Schema::drop('permissions');
		Schema::drop('permission_role');
		Schema::drop('role_user');
    }
}
