<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insertOrIgnore([
            [
                'id'        => 1,
                'm_jabatan_id'  => 0,
                'username'  => 'admin@gmail.com',
                'name'      => 'Admin Pro',
                'password'  => Hash::make(12345678),
                'sandi'     => '12345678',
                'phone'     => '082241698249',
                'alamat'    => 'Semarang',
                'm_role_id' => 1,
                'status'    => 1,
                'last_login'    => null
            ]
        ]);
    }
}
