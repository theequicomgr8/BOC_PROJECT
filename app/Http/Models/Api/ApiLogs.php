<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class ApiLogs extends Model
{
    use HasFactory;
    protected $connection = 'mysql';

    protected $table = 'activity_logs';

    protected $fillable = [
       'Userid',
       'Client_IP',
      'Activity_Id',
      'PageviewURL',
      'Module_Id'
      
    ];

    public static function fetchAllRecords($table)
    {
        $response = DB::table($table)
                        ->select('id','activity_name')
                        ->get();
        return $response;
    }

    public static function fetchAllRecordConditions($table,$select,$orderBy,$sort,$where='', $param='')
    {
        $response = DB::table($table); 
            $response->select($select);                    
            $response->OrderBy($orderBy,$sort);
            if(!empty($param)){
                $response->where($where,$param);
            } 
          $res=  $response->get();
        return $res;
    }

    public static function insertSingleData($table,$data)
    {
        $response = DB::connection('mysql')->table($table)->insert($data);
        return $response;
        //use this if you want to get insert ID.
        /*$response = DB::table($table)
                        ->insertGetId($data); */                      
    }
}
