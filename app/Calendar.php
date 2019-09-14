<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    //


    public function day() {
    	return $this->belongsTo('\App\Day');
    }
}
