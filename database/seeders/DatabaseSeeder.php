<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            'username' =>'admin',
            'first_name' => 'Admin',
            'user_email' =>'admin@admin.com',
            'user_mobile' =>'1111111',
            'password' => Hash::make('12345678'),
        ]);
    }
}
