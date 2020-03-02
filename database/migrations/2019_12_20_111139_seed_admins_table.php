<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $now = Carbon\Carbon::now()->toDateTimeString();

        $admin = [
            'name' => 'root',
            'password' => bcrypt('123456'),
            'email' => 'rbac123456@qq.com',
            'created_at' => $now,
            'updated_at' => $now,
        ];
        \DB::table('admins')->insert($admin);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::table('admins')->where('name', 'root')->delete();
    }
}
