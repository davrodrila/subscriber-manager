<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public static $TYPE_DATE = "date";
    public static $TYPE_NUMBER = "number";
    public static $TYPE_STRING = "string";
    public static $TYPE_BOOLEAN = "boolean";

    public function fields()
    {
        return $this->hasMany(Field::class);
    }
}
