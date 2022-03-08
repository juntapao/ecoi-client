<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insuran_price extends Model
{
    protected $table = 'insuran_prices';
    public $timestamps = true;
    protected $guarded = [];
    protected $dates = ['updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
