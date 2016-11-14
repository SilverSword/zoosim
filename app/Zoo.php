<?php

namespace ZooSim;

use Illuminate\Database\Eloquent\Model;

class Zoo extends Model
{
    /**
    * Get the animals in this zoo
    */
    public function animals()
    {
        return $this->hasMany('ZooSim\Animal');
    }
}
