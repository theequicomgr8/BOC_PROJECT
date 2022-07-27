<?php

namespace App\Imports;

use App\Models\Api\TAMCirculation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Session;
use DB;

class TAMExcelsImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $rows)
    {
        
        $get_data = DB::table('BOC$AV TAM$3f88596c-e20d-438c-a694-309eb14559b2')->select('TAM ID as tam_id')->OrderBy('TAM ID', 'desc')->first();
        if (date('m') <= 3) 
        {
            //Upto March
            $financial_year = (date('Y')-1) . '-' . (date('y'));
        } 
        else 
        {
            //After June
            $financial_year = date('Y') . '-' . (date('y') + 1);
        }
        
        

        if(empty($get_data))
        {
            $tam_id = '0000001';
        }
        else
        {
            $input = $get_data->tam_id + 1;
            $tam_id = str_pad($input, 6, "0", STR_PAD_LEFT);

        }
        
        $user_ip = $_SERVER['REMOTE_ADDR'];


        $file_name = str_replace("/","-",trim($rows['agency_code'])).".xls";
        // $file_name = str_replace("/","-","15401/0024/2021/AV");      
        
        return new TAMCirculation([
                    'TAM ID'            =>$tam_id, 
                    'JOB Code'          =>trim($rows['job_code']), 
                    'Agency Code'       =>trim($rows['agency_code']),
                    'Aired Date'        =>trim($rows['aired_date']),
                    'Start Time'        =>trim($rows['start_time']),
                    'End Time'          =>trim($rows['end_time']),
                    'Upload Date'       =>date("d-m-Y"),
                    'FIN Year'          =>$financial_year,
                    'File Name'         =>$file_name,
                    'TAM Spot Caption'  =>trim($rows['tam_spot_caption']),
                    'Brand Name'        =>trim($rows['brand_name']),
                    'Spot Lang'         =>trim($rows['spot_lang']),
                    'Spot Duration'     =>trim($rows['spot_duration']),
                    'Upload IP'         =>$user_ip,
            ]);          

            
            
        }

    }

// trim($rows['state']),
