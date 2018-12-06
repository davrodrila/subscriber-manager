<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class State extends Model
{
    /* Helper strings in the case of referring to states.
       The idea behind this is to avoid hard coding the values everywhere in the code.
     */
    public static $STATE_ACTIVE = "active";
    public static $STATE_UNSUBSCRIBED = "unsuscribed";
    public static $STATE_JUNK = "junk";
    public static $STATE_BOUNCED = "bounced";
    public static $STATE_UNCONFIRMED = "unconfirmed";

    public static function getStateByName($state)
    {
        $state = DB::table('states')->where('name','=',$state)->first();

        return $state;
    }

    public function subscribers()
    {
        return $this->hasMany(Subscriber::class);
    }
}
