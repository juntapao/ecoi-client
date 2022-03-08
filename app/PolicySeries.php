<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class PolicySeries extends Model {
    protected $table = 'policy_series';
    public $primarykey = 'id';
    public $timestamps = true;
    public function transaction() {
        return $this->belongsTo('App\Transaction');
    }
}
