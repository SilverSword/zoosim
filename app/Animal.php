<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    public function zoo()
    {
        return $this->belongsTo('App\Zoo');
    }

    public function specie()
    {
        return $this->belongsTo('App\Species');
    }

    public static function getAnimal($name)
    {
        return $this->species()->where('name', $name)->all();
    }

    public function elephants()
    {
        return getAnimal('Elephant');
    }

    public function giraffes()
    {
        return getAnimal('Giraffe');
    }

    public function monkeys()
    {
        return getAnimal('Monkey');
    }

    public function returnAnimals()
    {
        return $this->species()->orderBy('name', 'asc');
    }
}
