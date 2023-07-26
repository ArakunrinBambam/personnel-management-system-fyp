<?php

namespace Database\Seeders;

use App\Models\Configuration\Establishment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstablishmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Establishment::create(['name' => "ATSE", 'description' => "Administrative and Technical Staff Establishment"]);
        Establishment::create(['name' => "JSE", 'description' => "Junior Staff Establishment"]);
        Establishment::create(['name' => "ACSE", 'description' => "Academic Staff Establishment"]);

    }
}
