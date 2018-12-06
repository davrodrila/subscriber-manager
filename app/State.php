<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public static $STATE_ACTIVE ="active";
    public static $STATE_UNSUBSCRIBED = "unsuscribed";
    public static $STATE_JUNK = "junk";
    public static $STATE_BOUNCED = "bounced";
    public static $STATE_UNCONFIRMED = "unconfirmed";
}
