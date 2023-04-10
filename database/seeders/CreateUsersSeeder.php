<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

//Models
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create dummy users
        User::insert([
            [
                'name' => "Akande Salami",
                'email' => "anmolvarshney58@gmail.com",
                'password' => Hash::make('password'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => "Jeff Doe",
                'email' => "shraddhagupta435@gmail.com",
                'password' => Hash::make('password'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
        ]);
    }
}
