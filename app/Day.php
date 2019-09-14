<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    //
    // public function calendars() {
    //     return $this->hasMany('\App\Calendars');
    // }


    public function calendars() {
        return $this->hasMany('\App\Calendars');
    }
}
