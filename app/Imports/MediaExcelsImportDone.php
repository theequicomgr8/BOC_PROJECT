<?php

namespace App\Imports;

use App\Models\Api\MediaCirculationDone;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Session;
use DB;

class MediaExcelsImportDone implements ToModel, WithHeadingRow, WithCalculatedFormulas
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
        if($rows['proof_gst_submitted'] == 'Yes' || $rows['proof_gst_submitted'] == 'yes' )
        {
            $proof = 1;
        }
        else{
            $proof = 0;
        }
        

        if($rows['invoice_number']!='')
        {
            return new MediaCirculationDone([           
                'OD Media Type' => 0,  //0 replace by 2
                'OD Media ID' =>$od_mediaID,
                'Line No_' =>$lineNO,
                'Work Name' =>'',
                'Year' =>'',
                'Qty Of Display_Duration'=>0,
                'Billing Amount'=>0,
                'Allocated Vendor Code' =>'',
                'From Date' =>'2022-06-23 00:00:00.000',
                'To Date' =>'2022-06-23 00:00:00.000',
                'Work Done Status' => 1,
                'Client Name'=>trim($rows['client_name']),
                'Invoice Number'=>trim($rows['invoice_number']),
                'GST Party 1'=>trim($rows['gst_no_party_1']),
                'GST Party 2'=>trim($rows['gst_no_party_2']),
                'Proof GST Submitted'=>$proof,
                'Name of applicant'=>Session::get('applicant_name'),
                'Online application number'=>$od_mediaID,
                'Non receipt file name'=>'',
                'GST Receipts File Name'=>'',
                'GST Invoices File Name'=>''
            ]);
        }
    }
}


