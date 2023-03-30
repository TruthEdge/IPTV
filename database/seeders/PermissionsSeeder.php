<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {

        $permissionsList = [

            'users show',
            'users create',
            'users edit',
            'users delete',

            'accounts show',
            'accounts create',
            'accounts edit',
            'accounts delete',

            'roles show',
            'roles create',
            'roles edit',
            'roles delete',

            'prices show',
            'prices create',
            'prices edit',
            'prices delete',

            'transactions show',
            'transactions create',
            'transactions edit',
            'transactions delete',

            'vouchers show',
            'vouchers create',
            'vouchers edit',
            'vouchers delete',


            'vouchers pay pay',
            'vouchers pay pay',
            'vouchers pay pay',
            'vouchers pay pay',

            'settings show',

        ];
        $roles = [
            'Admin' => $permissionsList,
            'reseller' => [
                'accounts show',
                'accounts create',
                'accounts edit',
                'accounts delete',

                'transactions show',
                'transactions create',
                'transactions edit',
                'transactions delete',

            ],
        ];

        foreach ($roles as $role => $permissions) {
            $Role = Role::findOrCreate($role);
            foreach ($permissions as $permission) {
                Permission::findOrCreate($permission);
                $Role->syncPermissions(Permission::whereIn('name', $permissions)->get());
            }
        }
    }
}
