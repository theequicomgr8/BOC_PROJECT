<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class CommunityRadio extends Model
{
    use HasFactory;

    public static function FetchAllCommRadio($table,$select,$where=""){

    	 $response =DB::table($table)->select($select)->where($where)->get();
    	return $response;
    }
    public static function CommRadioupdateAlldata($table,$update,$where){
        //DB::enableQueryLog();
    	$res =DB::table($table)->where($where)->update($update);
        return $res;
    }
}
