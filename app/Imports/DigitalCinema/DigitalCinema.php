<?php

namespace App\Imports\DigitalCinema;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use DB;
use Session;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
// use Illuminate\Validation\Rule;
class DigitalCinema implements ToCollection,WithHeadingRow
{
    public function Collection(Collection $rows)
    {    $userid = session::get('UserID');
        $agencyFind=DB::table('BOC$Vend Emp Digital Cinema$3f88596c-e20d-438c-a694-309eb14559b2')
        ->select('Agency Code')->where('User ID',$userid)->first();
        foreach ($rows as $row)
        {    if($row['screen_type'] == "Single"){
                $screen =0;
             }else{
                $screen =1;
             }
             //dd($screen);
            $where=array("Agency Code"=>@$agencyFind->{'Agency Code'});
            $line=DB::table('BOC$Digital Cinema Screen$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where($where)->orderBy('Line No_','desc')->first();
            $line_no=@$line->{'Line No_'};
            // dd($line_no);
            if(empty($line))
            {
                $lineNo='1000';
            }
            else
            {
                $lineNo=$line_no+1;
            }
            DB::table('BOC$Digital Cinema Screen$3f88596c-e20d-438c-a694-309eb14559b2')->insert([
                "Agency Code" =>@$agencyFind->{'Agency Code'},
                "Line No_" => $lineNo,
                "Screen Unique Code"=> $row["screen_unique_code"],
                "Agency Contract Detail" =>'',
                "No_ Of Seats" =>$row['no_of_seats'],
                "Company Name"=>$row['company_name'],
                "Agency Name"=>$row['agency_name'],
                "Theatre Name"=>$row['theatre_name'],
                "Address"=>$row['address'],
                "District"=>$row['district'],
                "City"=>$row['city'],
                "State"=>$row['state'],
                "Pin code"=>$row['pin_code'],
                "Screen Type"=>$screen,
            ]);

        }
    }



}