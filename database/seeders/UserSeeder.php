<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $user = new User();
        $user->name ="Adedotun Bamidele";
        $user->email="adedotunolusegun@yahoo.com";
        $user->password=Hash::make("dotman");
        $user->save();

        $user1 = new User();
        $user1->name ="Tester User";
        $user1->email="tester@mailinator";
        $user1->password=Hash::make("tester");
        $user1->save();
    }
}
