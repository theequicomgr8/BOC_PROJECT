<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ApiFreshEmpanelment extends Model
{
    use HasFactory;

    public static function fetchAllRecords($table,$select,$orderBy='',$sort='',$where='')
    {
        $response = DB::table($table); 
            $response->select($select); 
            if(!empty($orderBy) && !empty($sort)){                   
            $response->OrderBy($orderBy,$sort);
            }
            if (!empty($where)) {
               // foreach($where as $key => $value) {
                    $response->where($where);
               // }
            }
          $res=  $response->get();
        return $res;
    }

    public static function updateAllRecords($table,$update,$where){
        return $res = DB::table($table)->where($where)->update($update);
    }
}
