<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'layvicha',
            'email' => 'layvicha@gmail.com',
            'password' => bcrypt('12345678'),
            'first_name' => 'Lay',
            'last_name' => 'Vicha',
            'gender' => 'male',
            'dob' => '2002-07-25',
            'phone_number' => '061560003',
            'bio' => 'I am the head of the program',
            'role_id' => 3,
        ]);

        User::create([
            'username' => 'sunsetthika',
            'email' => 'sunsetthika@gmail.com',
            'password' => bcrypt('12345678'),
            'first_name' => 'Sun',
            'last_name' => 'Setthika',
            'gender' => 'female',
            'dob' => '2002-02-27',
            'phone_number' => '061560003',
            'bio' => 'I am the head of the program',
            'role_id' => 3,
        ]);

        User::create([
            'username' => 'rachna',
            'email' => 'rachna@gmail.com',
            'password' => bcrypt('12345678'),
            'first_name' => 'Chan',
            'last_name' => 'Rachna',
            'gender' => 'female',
            'dob' => '2002-03-17',
            'phone_number' => '061560003',
            'bio' => 'I am the head of the program',
            'role_id' => 3,
        ]);

        User::create([
            'username' => 'zapon',
            'email' => 'hongzapon@gmail.com',
            'password' => bcrypt('12345678'),
            'first_name' => 'Hong',
            'last_name' => 'Zapon',
            'gender' => 'female',
            'dob' => '2002-03-17',
            'phone_number' => '061560003',
            'bio' => 'I am the head of the program',
            'role_id' => 3,
        ]);


        User::create([
            'username' => 'sreynith',
            'email' => 'sreynith@gmail.com',
            'password' => bcrypt('12345678'),
            'first_name' => 'Srey',
            'last_name' => 'Nith',
            'gender' => 'female',
            'dob' => '2002-05-15',
            'phone_number' => '061560003',
            'bio' => 'I am the head of the program',
            'role_id' => 3,
        ]);

        User::create([
            'username' => 'hengrathpisey',
            'email' => 'hengrathpisey@gmail.com',
            'password' => bcrypt('12345678'),
            'first_name' => 'Heng',
            'last_name' => 'Rathpisey',
            'gender' => 'female',
            'dob' => '2002-01-01',
            'phone_number' => '061560003',
            'bio' => 'I am the head of the program',
            'role_id' => 3,
        ]);

        User::create([
            'username' => 'yinsoknara',
            'email' => 'yinsoknara@gmail.com',
            'password' => bcrypt('12345678'),
            'first_name' => 'Yin',
            'last_name' => 'Soknara',
            'gender' => 'female',
            'dob' => '2002-01-01',
            'phone_number' => '061560003',
            'bio' => 'I am the head of the program',
            'role_id' => 3,
        ]);

        User::create([
            'username' => 'chhornkakada',
            'email' => 'chhornkakada@gmail.com',
            'password' => bcrypt('12345678'),
            'first_name' => 'Chhorn',
            'last_name' => 'Kakada',
            'gender' => 'female',
            'dob' => '2002-01-01',
            'phone_number' => '061560003',
            'bio' => 'I am the head of the program',
            'role_id' => 3,
        ]);

        User::create([
            'username' => 'doeurnsreynith',
            'email' => 'doeurnsreynith@gmail.com',
            'password' => bcrypt('12345678'),
            'first_name' => 'Doeurn',
            'last_name' => 'Sreynith',
            'gender' => 'female',
            'dob' => '2002-01-01',
            'phone_number' => '061560003',
            'bio' => 'I am the admin of graduate school',
            'role_id' => 2,
        ]);




    }
}
