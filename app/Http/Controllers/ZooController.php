<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use App\Zoo;
use App\Animal;
use App\Species;
use Carbon\Carbon;
use Request;
use Session;

/**
 * Zoo Controller: Main controller to handle all events
 */
class ZooController extends BaseController
{
    /**
     * initialization function to create a new zoo data Set
     * @return redirect to index
     */
    public function initialize()
    {
        $zoo = Zoo::first();
        if (!is_null($zoo)) {
            $zoo->delete();
        }

        $zoo = new Zoo;
        $zoo->start_time = Carbon::now();
        $zoo->save();

        $species = Species::all();
        foreach ($species as $specie)
        {
            for($i = 0; $i < 5; $i++) {
                $animal = new Animal;
                $animal->zoo_id = $zoo->id;
                $animal->specie_id = $specie->id;
                $animal->current_health = 1.00;
                $animal->is_dead = false;
                $animal->warning = false;
                $animal->save();
            }
        }

        return redirect()->route('index');
    }

    /**
     * Main index function
     * It will call the initialization function if the cache does not exists
     * or there is no Zoo record
     * @return view template zoo/index.blade.php
     */
    public function index()
    {

        $zoo = Zoo::first();
        // if we don't have a valid object we need to initialize the data
        if (is_null($zoo))
        {
            return redirect()->route('init');
        }

        $animals = $zoo->animals()->get();

        return view('zoo.index', [
            'animals' => $animals,
            'time' => floor(Carbon::parse($zoo->start_time)->diffInSeconds()/3600),
            'cache' => Session::get('simulation')
        ]);
    }

    /**
     * Feed function called when the user wants to feed the zoo animals
     * @return partial view template:zoo/table.blade.php
     */
    public function feed()
    {
        $zoo = Zoo::first();
        $animals = $zoo->animals()->get();

        // update health for each animal
        foreach ($animals as $index => $animal) {
            // only update if the animal is alive
            if (!$animal->is_dead)
            {
                $factor = rand(10,25) / 100;
                $animal->current_health = $this->increaseHealth($animal->current_health, $factor);
                // handle special rules for Elephants
                if ($animal->specie->name == 'Elephant' && $animal->current_health > $animal->specie->fatal_health_level)
                {
                    $animal->warning = false;
                }

                $animal->save();
            }
        }
        return view('zoo.table', ['animals' => $animals]);
    }

    /**
     * Advance Time incrementing function. Called when users clicks on the
     * 'Advance Time' button.
     *
     * @return partial view template:zoo/table.blade.php
     */
    public function advanceTime()
    {
        $zoo = Zoo::first();

        $start = Carbon::parse($zoo->start_time);
        // update time by setting the start time behind by one hour
        $zoo->start_time = $start->subHour();
        $zoo->save();

        $animals = $zoo->animals()->get();
        // calculate the new health for each animal
        foreach ($animals as $index => $animal) {
            // only update the animal health if it is still alive
            if (!$animal->is_dead)
            {
                $factor = rand(0,20) / 100;
                $animal->current_health = $this->decreaseHealth($animal->current_health, $factor);
                // update animal status if it is below the fatal health level
                if ($animal->current_health < $animal->specie->fatal_health_level)
                {
                    // exception for Elephants who can withstand one more round before dying
                    if ($animal->specie->name == 'Elephant' && !$animal->warning)
                    {
                        $animal->warning = true;
                    } else {
                        $animal->is_dead = true;
                    }
                }
                $animal->save();
            }

        }
        return view('zoo.table', ['animals' => $animals]);
    }

    /**
     * Internal function increaseHealth to calculate the new health level of an
     * animal
     *
     * @param  float $currentHealth current health value of the animal
     * @param  float $value         the incrementing factor
     * @return float                the new health value for the animal
     */
    private function increaseHealth($currentHealth, $value)
    {
        $newHealth = $currentHealth + $value;
        // Maximum health is 100%
        if ($newHealth >= 1.0) {
            return 1.0;
        }  else {
            return $newHealth;
        }
    }

    /**
     * Internal function decreaseHealth to calculate the new health value of an
     * animal
     *
     * @param  float $currentHealth current health value of the animal
     * @param  float $value         the decrementing factor
     * @return float                new health value of the animal
     */
    private function decreaseHealth($currentHealth, $value)
    {
        $newHealth = $currentHealth - $value;

        // Minimum health is 0%
        if ($newHealth < 0 ) {
            return 0;
        } else {
            return $newHealth;
        }
    }

}
