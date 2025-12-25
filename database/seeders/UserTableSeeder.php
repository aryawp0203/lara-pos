<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'username' => 'admin',
                'password' => bcrypt('123'),
                'foto' => '/img/user.png',
                'level' => 1, // 1=admin
            ],
            [
                'name' => 'Kasir',
                'email' => 'kasir@gmail.com',
                'username' => 'kasir',
                'password' => bcrypt('123'),
                'foto' => '/img/user.png',
                'level' => 2, // 2=kasir
            ],
        ];

        array_map(function (array $user) {
            User::query()->updateOrCreate(
                ['email' => $user['email'], 'username' => $user['username']],
                $user
            );
        }, $users);
    }
}
