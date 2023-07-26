<?php

namespace Database\Seeders;

use App\Models\Configuration\Faculty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     *
     * @return void
     */
    public function run()
    {
        $dept1 = ['Computer', 'Chemical', 'Food Tech', 'MSE'];

        $dept2 = ['Pensions', 'ACSE Unit', 'Research'];

        $faculty1 = Faculty::create(['name'=> 'Technology']);

        $faculty2 = Faculty::create(['name' => 'Personnel Administration']);

        foreach($dept1 as $dept){
            $faculty1->departments()->create(['name'=>$dept]);
        }

        foreach($dept2 as $dept){
            $faculty2->departments()->create(['name'=>$dept]);
        }
    }
}
