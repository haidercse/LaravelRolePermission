<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email','haider.cse7644@gmail.com')->first();
        if (is_null($user)) {
           $user = User::create([
                'name' => 'Shaiful Islam Haider',
                'email' => 'haider.cse7644@gmail.com',
                'password'=> Hash::make('01814256957'),
                'is_superadmin' => 1,
             ]);
            $user->assignRole('super admin');
        }



    }
}
