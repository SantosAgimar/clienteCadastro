<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!User::where('email', 'agimara@gmail.com')->first()){
            User::create([
                'name' => 'Agimar',
                'email' => 'agimara@gmail.com',
                'password' => Hash::make('123456a', ['rounds' => 12])
            ]);
        }
        if(!User::where('email', 'mateus@gmail.com')->first()){
            User::create([
                'name' => 'Mateus',
                'email' => 'mateus@gmail.com',
                'password' => Hash::make('123456m', ['rounds' => 12])
            ]);
        }
        if(!User::where('email', 'caio@gmail.com')->first()){
            User::create([
                'name' => 'Caio',
                'email' => 'caio@gmail.com',
                'password' => Hash::make('123456c', ['rounds' => 12])
            ]);
        }
        if(!User::where('email', 'hugo@gmail.com')->first()){
            User::create([
                'name' => 'Hugo',
                'email' => 'hugo@gmail.com',
                'password' => Hash::make('123456h', ['rounds' => 12])
            ]);
        }
        if(!User::where('email', 'rute@gmail.com')->first()){
            User::create([
                'name' => 'Rute',
                'email' => 'rute@gmail.com',
                'password' => Hash::make('123456r', ['rounds' => 12])
            ]);
        }
    }
}
