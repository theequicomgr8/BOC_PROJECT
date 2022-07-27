<?php

namespace App\Imports;

use App\Models\Api\AVTVCirculation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Session;
use DB;

class AVTVExcelsImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $rows)
    {
        $today = date('Y-m-d h:i:s', time());      
        $ro_no=Session::get('ro_no');

        $data = session()->all();
        
        $wingvalue=Session::get('WingType');
        if($wingvalue==5)
        {
            $wingtype='AV-Radio';
        }
        elseif($wingvalue==4)
        {
            $wingtype='Av-TV';
        }
        elseif($wingtype==7)
        {
            $wingtype='AV-Producers';
        }

        $table='[BOC$AV RO Line Details$3f88596c-e20d-438c-a694-309eb14559b2]';
        $line_no = DB::select("select TOP 1 [Line No_] from $table  order by [Line No_] desc");
        $line_no=DB::table('BOC$AV RO Line Details$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where(['RO No_'=>$ro_no,'Agency Code'=>Session::get('UserName')])->orderBy('Line No_','desc')->first();
        if (empty($line_no)) {
            $line_no = 10000;
        } else {
            $line_no = $line_no->{"Line No_"};
            $line_no = $line_no + 10000;
        }
        // $agencycode=Session::get('AgencyCode');
        $agencycode=Session::get('UserName');
        $year=date('Y');

        // $control_no=DB::table('BOC$RO Bill Detail Lines$3f88596c-e20d-438c-a694-309eb14559b2')->where('RO No_',Session::get('rocode'))->orderBy('Control No_','desc')->first();

        // if (empty($control_no)) {
        //     $control_no = $agencycode.'/'.$year.'/0001';
        // } 
        // else {
        //     $control_no = $control_no->{"Control No_"};
        //     $first_code=substr($control_no,0,12);
        //     $second_code=substr($control_no,12,4) + 1;           
        //     $input = 1;
        //     $num = str_pad($second_code, 4, "0", STR_PAD_LEFT);
        //     $control_no=$first_code.$num;       
        // }

        $rodata=DB::table('BOC$AV RO Line$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where(['Agency Code'=>$agencycode,"RO No_"=>Session::get('ro_no')])->first();
        $ro_line_no=$rodata->{'Line No_'};
        $agency_name=$rodata->{'Agency Name'};
        // dd($rodata->{'Language'});
        
        return new AVTVCirculation([
                    'RO No_'                                =>$ro_no,
                    'RO Line No_'                           =>$ro_line_no,
                    'Line No_'                              =>$line_no,
                    'Agency Code'                           =>$agencycode,
                    'Amount'                                =>0,    
                    'Agency Name'                           =>$agency_name,
                    'Language'                              =>$rodata->{'Language'},
                    'Remarks'                               =>'', //trim($rows['caption']),
                    'Aired Time'                            =>trim($rows['aired_time']),
                    'Aired Date'                            =>trim($rows['aired_date']),
                    'Spot Duration'                         =>trim($rows['claimed_spot_duration']),
                    'Description'                           =>'',
                    'TV Channel Code'                       =>'',
                    'TV Channel Name'                       =>'',
                    'Head Quarter Code'                     =>'',
                    'Head Quarter Name'                     =>'',
                    'Telecast_Broadcast From Date'          =>'1753-01-01 00:00:00.000',
                    'Telecast_Broadcast To Date'            =>'1753-01-01 00:00:00.000',
                    'RO Code'                               =>'',
                    'Station Code'                          =>'',
                    'Station Name'                          =>'',    
                    'State'                                 =>'',
                    'State Name'                            =>'',    
                    'Time Band'                             =>'',
                    'Vendor No_'                            =>'',
                    'Vendor GST No_'                        =>'',
                    'Vendor Bill No_'                       =>'',
                    'Vendor Bill Date'                      =>'1753-01-01 00:00:00.000',
                    'Submission Date'                       =>'1753-01-01 00:00:00.000',
                    'Bill Claim Amount'                     =>trim($rows['claim_amount']),
                    'Bill Approved Amount'                  =>0,
                    'Compliance DateTime(Audit)'            =>'1753-01-01 00:00:00.000',
                    'Billing DateTime(Audit)'               =>'1753-01-01 00:00:00.000',
                    'Purchase Invoice No_'                  =>''

                ]);          

 
            
        }

    }

// trim($rows['state']),

    // 'Transaction Type'       =>$wingvalue, 
    // 'RO No_'                 =>Session::get('ro_no'), 
    // 'RO Line No_'            =>$ro_line_no,
    // 'Line No_'               =>$line_no,
    // 'Control No_'            =>$control_no,
    // 'Air Date and Time'      =>trim($rows['aired_date']),
    // 'Start Air Time'         =>'1753-01-01 00:00:00.000',
    // 'Duration'               =>trim($rows['claimed_spot_duration']),
    // 'Remark'                 =>trim($rows['caption'])
