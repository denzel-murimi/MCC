<?php

namespace Database\Seeders;

use App\Models\Child;
use App\Models\Program;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         User::factory(10)->create();
//
//        Program::factory(20)->create();
//
//        Child::factory(10)->create();

        User::create([
            'name' => 'Victor',
            'email' => 'victor@matharecarecenter.com',
            'password' => Hash::make('password'),
        ]);
    }
}
