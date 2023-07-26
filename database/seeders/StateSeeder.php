<?php

namespace Database\Seeders;

use App\Models\Configuration\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{


     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = json_decode(file_get_contents(resource_path('states.json'),true),true);

        foreach($json as $statedata)
        {
            $state = State::create(['name' => $statedata['state']]);

            foreach($statedata['lgas'] as $lga ){

                $state->lgas()->create(['name' => $lga]);

            }

        }
    }
}
