<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $guarded = [];
    protected $dates = ['updated_at'];

    public function userrole()
    {
        return $this->belongsTo('App\UserRole');
    }
}
