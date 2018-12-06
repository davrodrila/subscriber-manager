<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
