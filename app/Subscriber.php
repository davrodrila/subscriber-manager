<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    //


    public function state()
    {
        return $this->hasOne(State::class);
    }
}
