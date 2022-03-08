<?php
namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
class Test extends Model {
    // public static function userData($id=0){
    //     if($id==0){
    //         $value=DB::table('users')->orderBy('id', 'asc')->get(); 
    //       }else{
    //         $value=DB::table('users')->where('id', $id)->first();
    //       }
    //       return $value;
    // }
    protected $table = 'areas';
    // public $primarykey = 'region';
    public $timestamps = true;
}
