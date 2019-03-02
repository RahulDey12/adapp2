<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdsDetails extends Model
{
    protected $table = 'ads_details';

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function ads() {
        return $this->belongsTo('App\Ads');
    }
}
