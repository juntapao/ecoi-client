<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionBackup extends Model
{
    protected $table = 'transaction_backup';
    public $primarykey = 'id';
    public $timestamps = true;
   
    public function policyseries() {
        return $this->hasMany('App\PolicySeries');
    }
    public function insuran_price() {
        return $this->hasMany('App\Insuran_price');
    }
    public function user() {
        return $this->belongsTo('App\User', 'userid_created');
    }
}
