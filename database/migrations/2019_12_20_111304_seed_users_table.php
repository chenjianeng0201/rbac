<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $now = Carbon\Carbon::now()->toDateTimeString();

        $user = [
            'name' => 'root',
            'password' => bcrypt('123456'),
            'email' => 'rbac123456@qq.com',
            'created_at' => $now,
            'updated_at' => $now,
        ];
        \DB::table('users')->insert($user);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::table('users')->where('name', 'root')->delete();
    }
}
