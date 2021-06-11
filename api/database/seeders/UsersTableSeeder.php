<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()
            ->updateOrCreate([
                'email'      => 'test@test.com',
                'name'       => 'user.test',
                'password'   => Hash::make('12345'),
            ]);
    }
}
