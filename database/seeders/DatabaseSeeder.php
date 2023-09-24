<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::factory()->create([
            'name' => "admin",
            'email' => "admin@gmail.com",
            'usertype' => "1",
            'phone' => "0598399738",
            'address' => "tulkarm",
            'password' =>Hash::make("123456789"),
        ]);

        
        
        \App\Models\User::factory()->create([
            'name' => "omar",
            'email' => "omar@gmail.com",
            'usertype' => "0",
            'phone' => "0598399737",
            'address' => "tulkarm",
            'password' =>Hash::make("123456789"),
        ]);


        \App\Models\User::factory()->create([
            'name' => "alaa",
            'email' => "alaa@gmail.com",
            'usertype' => "0",
            'phone' => "0598399730",
            'address' => "tulkarm",
            'password' =>Hash::make("123456789"),
        ]);

        
        \App\Models\User::factory()->create([
            'name' => "ihap",
            'email' => "ihap@gmail.com",
            'usertype' => "0",
            'phone' => "0598399732",
            'address' => "tulkarm",
            'password' =>Hash::make("123456789"),
        ]);

        
        \App\Models\User::factory()->create([
            'name' => "abd",
            'email' => "abd@gmail.com",
            'usertype' => "0",
            'phone' => "0598399733",
            'address' => "tulkarm",
            'password' =>Hash::make("123456789"),
        ]);

        \App\Models\User::factory()->create([
            'name' => "ahmed",
            'email' => "ahmed@gmail.com",
            'usertype' => "0",
            'phone' => "0598399734",
            'address' => "tulkarm",
            'password' =>Hash::make("123456789"),
        ]);


        
    }
}