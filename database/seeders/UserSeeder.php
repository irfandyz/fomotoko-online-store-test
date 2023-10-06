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
        $data = [
            [
            'name'=>'Hans',
            'email'=>'hans@email.com',
            'password'=>bcrypt('123123'),
            'role'=>'admin',
            ],
            [
            'name'=>'Alex',
            'email'=>'alex@email.com',
            'password'=>bcrypt('123123'),
            'role'=>'user',
            ],
            [
            'name'=>'Van',
            'email'=>'van@email.com',
            'password'=>bcrypt('123123'),
            'role'=>'user',
            ],
            [
            'name'=>'cale',
            'email'=>'cale@email.com',
            'password'=>bcrypt('123123'),
            'role'=>'user',
            ],
        ];

        foreach ($data as $value) {
            User::create($value);
        }

    }
}
