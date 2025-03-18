<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // `admin` rolunu yaradın
        $role = Role::create(['name' => 'admin']);

        // İstifadəçiyə `admin` rolunu təyin edin
        $user = User::find(1); // Burada istifadəçi ID-si 1-dir, siz öz istifadəçi ID-nizi istifadə edə bilərsiniz
        if ($user) {
            $user->assignRole('admin');
        }
    }
}
