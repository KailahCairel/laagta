<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;  
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create an admin role if it doesn't exist
        $adminRole = Role::firstOrNew(['name' => 'admin']);
        if (!$adminRole->exists) {
            $adminRole->save();
        }

        // Create a user role if it doesn't exist
        $userRole = Role::firstOrNew(['name' => 'user']);
        if (!$userRole->exists) {
            $userRole->save();
        }
        $faker = \Faker\Factory::create();

        // Create an admin user
        User::create([
            'name' => 'Shean',
            'email' => 'sheanlouisemargallo@gmail.com',
            'phone' => $faker->unique()->phoneNumber,
            'location' => $faker->unique()->address,
            'password' => Hash::make('password'), // Hash the password
        ])->roles()->syncWithoutDetaching($adminRole->id);

        // Use Faker to generate user data

        // Create up to 50 users
        for ($i = 0; $i < 50; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'location' => $faker->unique()->address,
                'phone' => $faker->unique()->phoneNumber,
                'password' => Hash::make('password'), // You can set a default password
            ])->roles()->syncWithoutDetaching($userRole->id);
        }

        // You can add more users with different roles here
    }
}
