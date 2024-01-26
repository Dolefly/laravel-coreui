<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $faker = \Faker\Factory::create();

        // Add the master administrator, user id of 1
        $users = [
            [
                'first_name'        => 'Dominic',
                'last_name'         => 'Domi',
                'name'              => 'Dominic Domi',
                'email'             => 'dolefly@gmail.com',
                'password'          => Hash::make('september21'),
                'username'          => 'Dolefly',
                'mobile'            => $faker->phoneNumber,
                'date_of_birth'     => $faker->date,
                'avatar'            => 'img/default-avatar.jpg',
                'gender'            => $faker->randomElement(['Male', 'Female', 'Other']),
                'email_verified_at' => Carbon::now(),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]
        ];

        foreach ($users as $user_data) {
            $user = User::create($user_data);
        }

        Schema::enableForeignKeyConstraints();
    }
}
