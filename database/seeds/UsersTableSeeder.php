<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Админ',
                'email' => 'admin@gmail.com',
                'password' => bcrypt(Str::random(16)),
                'role_id' => 1,
            ]
        ];

        DB::table('users')->insert($data);
    }
}
