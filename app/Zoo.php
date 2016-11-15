<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zoo extends Model
{
    public function animals()
    {
        return $this->hasMany('App\Animal');
    }

    protected static function boot() {
        parent::boot();

        static::deleting( function($zoo) {
            $zoo->animals()->delete();
        });
    }
}
