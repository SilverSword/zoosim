<?php

namespace ZooSim;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    /**
    * Get the zoo that this animal belongs to
    */
    public function zoo()
    {
        return $this->belongsTo('ZooSim\Zoo');
    }
    
    public function specie()
    {
        return $this->belongsTo('ZooSim\Specie');
    }
}
