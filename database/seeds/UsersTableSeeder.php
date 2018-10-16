<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentDate = date('Y-m-d H:i:s');
        $email = 'admin@admin.com';
        $alreadyExist = DB::table('users')->where('email',$email);

        if(!$alreadyExist->count()) {
            DB::table('users')->insert([
                'name' => 'Admin Admin',
                'email' => $email,
                'password' => bcrypt('test123'),
                'is_verified' => 1,
                'created_at' => $currentDate,
                'updated_at' => $currentDate
            ]);
        }
    }
}
