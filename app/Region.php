<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public $timestamps = true;
    protected $guarded = [];
    protected $dates = ['updated_at'];

    // protected $with = ['areas'];

    public function areas()
    {
        return $this->hasMany(Area::class);
    }
}
