<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $user = User::create([
            'email' => 'HDR@gmail.com'
            , 'password' => Hash::make('Hdr@2132')
        ]);
        $user->assignRole('admin')  ;

        $user1 = User::create([
            'email' => 'sytpra@gmail.com'
            , 'password' => Hash::make('sytpra@2132')
        ]);

        $user1->assignRole('admin')  ;
    }
}
