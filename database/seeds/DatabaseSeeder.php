<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert(
            [
                'firstname' => 'Aarohan',
                'lastname' => 'Nakarmi',
                'username' => 'admin',
                'email' => 'admin'.'@3Techies.com',
                'password' => bcrypt('3Techies'),
                'phone' => '9800985145',
                'address' => 'Imadol,Lalitpur',
                'dob' => '1998/12/19',
                'gender' => 'M',
                'isAdmin' => 1,
            ]);
    }
}
