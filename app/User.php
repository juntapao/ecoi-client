<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    public $timestamps = true;
    protected $guarded = [];
    protected $dates = ['updated_at'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
        // 'id', 'branch_id'
        // 'branch_id', 'id'
    }

    public function user_role()
    {
        return $this->belongsTo(UserRole::class, 'role_id', 'id');
    }
    
    // public function transactions() {
    //     return $this->hasMany(Transaction::class, 'id', 'userid_created');
    // }
}
