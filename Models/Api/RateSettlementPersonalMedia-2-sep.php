<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class RateSettlementPersonalMedia extends Model
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
}
