<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class PrivateMedia extends Model
{
    use HasFactory;

    public static function fetchAllRecords($table, $select, $orderBy = '', $sort = '', $where = '', $whereIn = '', $pluck = '')
    {
        $response = DB::table($table);
        $response->select($select);
        if (!empty($orderBy) && !empty($sort)) {
            $response->OrderBy($orderBy, $sort);
        }
        if (!empty($where)) {
            foreach ($where as $key => $value) {
                $response->where($key, '=', $value);
            }
        }
        if (!empty($whereIn)) {
            foreach ($whereIn as $key => $value) {
                $response->whereIn($key, $value);
            }
        }
        if($pluck != ''){
        $res = $response->pluck($pluck)->all();
        }else{
        $res = $response->get();
        }
        return $res;
    }

    public static function insertSingleData($table, $data)
    {
        $response = DB::table($table)->insert($data);
        return $response;
    }
    public static function updateAllRecords($table, $update, $where)
    {
        return $res = DB::table($table)->where($where)->update($update);
    }
   
}
