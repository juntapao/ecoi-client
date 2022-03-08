<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public $timestamps = true;
    protected $guarded = [];
    protected $dates = ['updated_at'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
