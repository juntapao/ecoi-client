<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Detailed extends Model {
    protected $table = 'transaction';
    public $primarykey = 'id';
    public $timestamps = true;
}
