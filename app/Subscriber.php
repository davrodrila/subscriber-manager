<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{

    protected $fillable = ['name', 'email'];

    public function state()
    {
        return $this->hasOne(State::class);
    }
}
