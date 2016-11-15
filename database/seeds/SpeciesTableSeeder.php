<?php

use Illuminate\Database\Seeder;
use App\Species;

class SpeciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Species::create([
            'name' => 'Giraffe',
            'fatal_health_level' => 0.50
        ]);
        Species::create([
            'name' => 'Monkey',
            'fatal_health_level' => 0.30
        ]);
        Species::create([
            'name' => 'Elephant',
            'fatal_health_level' => 0.70
        ]);
    }
}
