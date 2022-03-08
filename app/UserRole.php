<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'user_roles';
    public $timestamps = true;
    protected $guarded = [];
    protected $dates = ['updated_at'];

    public function users()
    {
        return $this->hasMany('App\User', 'id', 'role_id');
    }

    public function menu()
    {
        return $this->hasMany('App\Menu');
    }
}
