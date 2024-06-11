<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // data
        $data = [
            'admin' => [
                'name' => 'Mforbesi Buesi',
                'email' => 'admin@rrp.com',
                'mobile' => '676396854',
                'password' => Hash::make('admin1234'),
                'username' => 'Rocheli',
                'role' => 'admin',
                'status' => 1]

        ];

        // seed the db
        foreach ($data as $role => $userData)
            DB::table('users')->insert($userData);
    }
}
