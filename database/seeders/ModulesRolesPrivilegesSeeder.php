<?php

namespace Database\Seeders;

//library
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Str;

//models
use App\Models\RoleModel;
use App\Models\PrivilegesModel;

class ModulesRolesPrivilegesSeeder extends Seeder
{
    private $privId = 1;
    private $rpId = 1;
    private $modulesPrivileges = array();
    private $moduleIds = [
       'Dashboard' => 1,
       //master data
       'Users' => 2,
       'Jabatan' => 3,
       'Shift' => 4,
       'Absensi' => 5,
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = array();
        foreach($this->moduleIds as $name => $id) {
            $modules[] = [
                'id' => $id,
                'nama' => $name
            ];
        }
        DB::table('m_modules')->insertOrIgnore($modules);

        /**
         * PRIVILEGES TABLE INSERT
         * START
         */
        $privileges = array();

        /**
         * Dashboard 
         */
        $privileges = $this->shapePrivilegeData($this->moduleIds['Dashboard'], $privileges, [
            'dashboardr' => 'Lihat Dashboard',
            'dashboardDatar' => 'Lihat Dashboard Data',
        ]);
        
        /**
         * Users
         */
        $privileges = $this->shapePrivilegeData($this->moduleIds['Users'], $privileges, [
            'usersc' => 'Tambah Users',
            'usersr' => 'Lihat Users',
            'usersu' => 'Update Users',
            'usersd' => 'Hapus Users',
        ]);

        /**
         * Jabatan
         */
        $privileges = $this->shapePrivilegeData($this->moduleIds['Jabatan'], $privileges, [
            'jabatanc' => 'Tambah Jabatan',
            'jabatanr' => 'Lihat Jabatan',
            'jabatanu' => 'Update Jabatan',
            'jabatand' => 'Hapus Jabatan',
        ]);

        /**
         * Shift
         */
        $privileges = $this->shapePrivilegeData($this->moduleIds['Shift'], $privileges, [
            'shiftc' => 'Tambah Shift',
            'shiftr' => 'Lihat Shift',
            'shiftu' => 'Update Shift',
            'shiftd' => 'Hapus Shift',
        ]);

        /**
         * Absensi
         */
        $privileges = $this->shapePrivilegeData($this->moduleIds['Absensi'], $privileges, [
            'absensic' => 'Tambah Absensi',
            'absensir' => 'Lihat Absensi',
            'absensiu' => 'Update Absensi',
            'absensid' => 'Hapus Absensi',
        ]);

        DB::table('m_privileges')->insertOrIgnore($privileges);

        $superAdminPrivileges = [
            'modules' => [
                'Dashboard',
                'Users',
                'Jabatan',
                'Shift',
                'Absensi',
            ]
        ];
        $operatorPrivileges = [
            'modules' => [
                'Dashboard',
                'Users',
                'Jabatan',
                'Shift',
                'Absensi',
            ]
        ];
        $staffPrivileges = [
            'modules' => [
                'Dashboard',
                'Absensi',
            ]
        ];
        $this->givePrivileges($superAdminPrivileges, 'superadmin');
        $this->givePrivileges($operatorPrivileges, 'operator');
        $this->givePrivileges($staffPrivileges, 'staff');
    }
    private function shapePrivilegeData($moduleId, $privilegesArr, $data) {
        foreach($data as $kode => $nama) {
            $privilegesArr[] = [
                'id' => $this->privId++,
                'm_module_id' => $moduleId,
                'kode' => $kode,
                'nama' => $nama
            ];
        }
        $this->modulesPrivileges[$moduleId] = $data;
        return $privilegesArr;
    }

    private function givePrivileges($data, $kodeRole) {
        $modulesInput = array_key_exists('modules', $data) ? $data['modules'] : [];
        $privilegesInput = array_key_exists('privileges', $data) ? $data['privileges'] : [];
        $privilegesToGive = array();
        $roleId = RoleModel::where('kode', $kodeRole)->pluck('id')->first();
        foreach($modulesInput as $input) {
            foreach($this->modulesPrivileges[$this->moduleIds[$input]] as $privilege => $_) {
                $privilegesToGive[$privilege] = true;
            }
        }

        foreach($privilegesInput as $privilege) {
            if(Str::startsWith($privilege,'-')) {
                unset($privilegesToGive[Str::after($privilege, '-')]);
            } else {
                $privilegesToGive[$privilege] = true;
            }
        }

        foreach($privilegesToGive as $privilege => $_) {
            $privilegeId = PrivilegesModel::where('kode', $privilege)->pluck('id')->first();
            $rolePrivilege = [
                'id' => $this->rpId++,
                'm_role_id' => $roleId,
                'm_privilege_id' => $privilegeId
            ];

            DB::table('m_roles_privileges')->insertOrIgnore($rolePrivilege);
        }


    }
}
