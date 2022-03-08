<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public $timestamps = true;
    // protected $with = ['region'];
    protected $guarded = [];
    protected $dates = ['updated_at'];

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
