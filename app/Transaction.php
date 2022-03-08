<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $timestamps = true;

    protected $dates = [
        'guardian_dateofbirth',
        'guardian_dateofbirth2',
        'child_siblings_dateofbirth',
        'child_siblings_dateofbirth2',
        'child_siblings_dateofbirth3',
        'child_siblings_dateofbirth4',
    ];

    protected $fillable = ['coi_number','policy_number','bos_entry_number',
        'ticket_number','insured_name','address','civil_status','beneficiary','relationship',
        'dateofbirth','guardian','guardian_dateofbirth','guardian2','guardian_dateofbirth2',
        'child_siblings','child_siblings_dateofbirth','child_siblings2','child_siblings_dateofbirth2',
        'child_siblings3','child_siblings_dateofbirth3','child_siblings4','child_siblings_dateofbirth4',
        'insured_name','type','price'
    ];
    // protected $with = ['user'];
    // public function branch() {
    //     return $this->hasMany('App\Branch');
    // }

    public function policyseries()
    {
        return $this->hasMany('App\PolicySeries');
    }

    public function insuran_price()
    {
        return $this->hasMany('App\Insuran_price');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'userid_created');
        // 'userid_created', 'id'
        // 'id', 'userid_created'
    }
}
