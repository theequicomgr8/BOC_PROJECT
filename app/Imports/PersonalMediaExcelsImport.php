<?php

namespace App\Imports;

use App\Models\Api\MediaCirculation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Session;
use DB;

class PersonalMediaExcelsImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $rows)
    {
        $od_mediaID=Session::get('ex_odmediaid');
        $table='BOC$OD Media Category';
        $table2='BOC$Sole Medias Address';
        $lineNO=DB::table($table2)->select('Line No_')->where('Sole Media ID',$od_mediaID)->orderBy('Line No_','desc')->first();
        if (empty($lineNO->{'Line No_'})) {
            $lineNO = 10000;
        } else {
            $lineNO = $lineNO->{"Line No_"};
            $lineNO++;
        }
        // dd($lineNO->{'Line No_'});
        //media_sub_category for sub category
        // dd($rows['media_sub_category']);
        if($rows['media_category'] == 'Airport')
        {
                $media_category = 0;
        }
        else if($rows['media_category'] == 'Railway Station')
        {
            $media_category = 1;
        }
        else if($rows['media_category'] == 'Road side ')
        {
            $media_category = 2;
        }
        else if($rows['media_category'] == 'Moving Media')
        {
            $media_category = 3;
        }
        else if($rows['media_category'] == 'Public utility')
        {
            $media_category = 4;
        }
            
        $category=DB::table($table)->select('OD Media UID')->where('Name',$rows['media_sub_category'])->first();
        // dd($category->{'OD Media UID'});
        // $sub_category = DB::table('OD Media Category')->select('OD Media ID')->where('sub categoryname',$rows['sub_category_name'])->first();
        // dd($odmedia_id);

        // dd($rows);

        
        return new MediaCirculation([
            'State'                     => '',
            'District'                  => '', 
            'City'                      => '',
            'Zone'                      => 0,
            'Display Size'              => 0,
            'Illumination Type'         => 0,
            'Availability Start Date'   => '1753-01-01',
            'Availability End Date'     => '1753-01-01',
            'OD Media Type'             =>$media_category, //for category
            'Sole Media ID'             =>$od_mediaID,
            'Line No_'                  =>$lineNO,
            'Latitude'                  =>0.0,
            'Longitde'                  =>0.0,
            'Landmark'                  =>'',
            'Image File Name'           =>'',
            'OD Media ID'               =>$category->{'OD Media UID'}, //for sub-category
            'Quantity'                  =>0,
            'Length'                    =>0,
            'Width'                     =>0,
            'Total Area'                =>0,
            'Rental'                    =>0,
            'Rental Type'               =>0
        ]);
    }
}



