<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';
    public $timestamps = false;

    public function users() {
        return $this->belongsTo('App\User');
    }
}
