<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_roles')->insertOrIgnore([
            [
                'id'        => 1,
                'kode'      => 'superadmin',
                'nama'      => 'Super Admin',
            ], 
            [
                'id'        => 2,
                'kode'      => 'operator',
                'nama'      => 'Operator',
            ],
            [
                'id'        => 3,
                'kode'      => 'staff',
                'nama'      => 'Staff',
            ]
        ]);
    }
}
