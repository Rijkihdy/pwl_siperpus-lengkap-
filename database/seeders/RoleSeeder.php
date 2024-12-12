<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      // Membuat Role pustakawan
      $pustakawanRole = Role::create(['name' => 'pustakawan']);
        
      // Membuat Role mahasiswa
      $mahasiswaRole = Role::create(['name' => 'mahasiswa']);
      
      // Membuat Permissions
      $editBookPermission = Permission::create(['name' => 'edit_book']);
      $editUserPermission = Permission::create(['name' => 'edit_user']);
      $viewBookPermission = Permission::create(['name' => 'view_book']);

      // Menghubungkan Permission ke Role pustakawan
      $pustakawanRole->permissions()->attach([
          $editBookPermission->id,
          $editUserPermission->id
      ]);

      // Menghubungkan Permission ke Role mahasiswa
      $mahasiswaRole->permissions()->attach([
          $viewBookPermission->id
      ]);
    }
}
