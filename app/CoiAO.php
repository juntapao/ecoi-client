<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class CoiAO extends Model {
    protected $table = 'coi_ao';
    public $primarykey = 'id';
    public $timestamps = true;
    public function branch() {
        return $this->hasMany('App\Branch');
    }
    public function policyseries() {
        return $this->hasMany('App\PolicySeries');
    }
    public function insuran_price() {
        return $this->hasMany('App\Insuran_price');
    }
}
