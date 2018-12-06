<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = ['title', 'type_id'];
    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
