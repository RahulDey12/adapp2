<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $table = "ads";

    public function user() {
        return $this->belongsTo('App\User');
    }
}
