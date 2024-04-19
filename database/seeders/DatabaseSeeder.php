<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('admin'),
            'role'=>'admin',
        ]);

        User::create([
            'name'=>'employe',
            'email'=>'employe@gmail.com',
            'password'=>bcrypt('employe'),
            'role'=>'employe',
        ]);
    }
}
