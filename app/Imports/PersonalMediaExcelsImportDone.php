<?php

namespace App\Imports;

use App\Models\Api\MediaCirculationDone;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Session;
use DB;

class PersonalMediaExcelsImportDone implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $rows)
    {
        // dd($rows);
        $od_mediaID=Session::get('ex_odmediaid');
        $table2='BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2';
        $lineNO=DB::table($table2)->select('Line No_')->where('OD Media ID',$od_mediaID)->orderBy('Line No_','desc')->first();
        if (empty($lineNO->{'Line No_'})) {
            $lineNO = 10000;
        } else {
            $lineNO = $lineNO->{"Line No_"};
            $lineNO++;
        }

        

        if($rows['duration']!='')
        {
            return new MediaCirculationDone([
                'OD Media Type' => 1,  //0 replace by 2
                'OD Media ID' =>$od_mediaID,
                'Line No_' =>$lineNO,
                'Work Name' =>'',
                'Year' =>'',
                'Qty Of Display_Duration' => trim($rows['duration']),
                'Billing Amount' =>trim($rows['amount']),
                'Allocated Vendor Code' =>'',
                'From Date' =>trim($rows['from_date']),
                'To Date' =>trim($rows['to_date'])
            ]);
        }
    }
}



