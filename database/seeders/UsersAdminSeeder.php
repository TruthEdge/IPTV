<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class UsersAdminSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {

        if(!User::where('email','info@lfait.com')->first()) {
            $user = User::create([
                'name' => 'Admin',
                'email' => 'info@lfait.com',
                'mobile' => '',
                'password' => Hash::make("Admin@123!@#"),
                'status' => 1,
                'gender' => 1,
            ]);

            $user->assignRole('Admin');

        }

    }
}
