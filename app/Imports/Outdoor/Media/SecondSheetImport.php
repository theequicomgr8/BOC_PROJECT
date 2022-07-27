<?php

namespace App\Imports\Outdoor\Media;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Api\MediaCirculation;
use App\Models\Api\ODLatLong;
use Session;
use DB;
use App\Http\Traits\outdoorMediaTableTrait;
 
class SecondSheetImport implements ToModel, WithHeadingRow
{
    use  outdoorMediaTableTrait;

    public function model(array $rows)
    {
        $od_mediaID = Session::get('ex_odmediaid');
        $userId = Session::get('UserID');

        $media_cat = array('0' => 'Airport', '1' => 'Railways', '2' => 'Road', '3' => 'Transit Media', '4' => 'Others', '5' => 'Metro', '6' => 'Bus & Station');
        foreach ($media_cat as $k => $cat_val) {
            if ($rows['category'] == $cat_val) {
                $media_category = $k;
            }
        }

        //for illumination 
        $illumination_type = $rows['illumination'] == 'Lit' ? 1 : 2;

        //for lit type
        if ($illumination_type == 1) {
            $lit_type = $rows['lit_type'] == 'Front Lit' ? 1 : 2;
        } else {
            $lit_type = 0;
        }

        //for Size type
        // $size_type = $rows['size_type'] == 'CM' ? 1 : 2;

        $category = DB::table($this->tableODMediaCategory)->select('OD Media UID')->where('Name', $rows['sub_category'])->first();
        $vendor_where = array("User ID" => $userId, "OD Category" => 0, "OD Media ID" => $od_mediaID);

        // $vendor_data = DB::table($this->tableVendorEmpODMedia)->select('OD Media ID')->where($vendor_where)->get()->toArray();
        // $od_ids_array = json_decode(json_encode($vendor_data), true);

        // $ODMediaID = DB::table($this->tableSoleMediasAddress)->select('OD Media ID')->where(['OD Media Type' => $media_category, 'OD Media ID' => $category->{'OD Media UID'}])->whereIn('Sole Media ID', $od_ids_array)->get()->toArray();
      
        // if (empty($ODMediaID)) {
            // get sub cat UID
            $vendor_data = array();
            if ($media_category == 3) {
                $vendor_data["Modification"] = 1;
                $vendor_data["Document Date"] = date('Y-m-d');
                $sql = DB::table($this->tableVendorEmpODMedia)->where($vendor_where)->update($vendor_data);
            }

            $quantity = DB::table($this->tableSoleMediasAddress)->select('Quantity')->where(['Sole Media ID' => $od_mediaID, 'OD Media Type' => $media_category, 'OD Media ID' => $category->{'OD Media UID'}])->first();
            if (empty($quantity)) {

                $lineNO = DB::table($this->tableSoleMediasAddress)->select('Line No_')->where('Sole Media ID', $od_mediaID)->orderBy('Line No_', 'desc')->first();
                if (empty($lineNO->{'Line No_'})) {
                    $lineNO = 10000;
                } else {
                    $lineNO = $lineNO->{"Line No_"};
                    $lineNO = $lineNO + 10000;
                }
                $data = array(
                    'State'                     => trim($rows['state']),
                    'District'                  => '',
                    'City'                      => '',
                    'Zone'                      => 0,
                    'Display Size'              => 0,
                    'Illumination Type'         => trim($illumination_type),
                    'Availability Start Date'   => '',
                    'Availability End Date'     => '',
                    'OD Media Type'             => trim($media_category), //for category
                    'Sole Media ID'             => $od_mediaID,
                    'Line No_'                  => $lineNO,
                    'Latitude'                  => 0.0,
                    'Longitde'                  => 0.0,
                    'Landmark'                  => '',
                    'Image File Name'           => '',
                    'OD Media ID'               => trim($category->{'OD Media UID'}), //for sub-category
                    'Quantity'                  => 1,
                    'Length'                    => trim($rows['length']),
                    'Width'                     => trim($rows['width']),
                    'Total Area'                => trim($rows['length'] * $rows['width']),
                    'Rental'                    => 0,
                    'Rental Type'               => 0,
                    'Train Number'              => 0,
                    'Train Name'                => '',
                    'Size Type'                 => 0,
                    'Duration'                  => 0,
                    'No Of Spot'                => 0,
                    'Lit Type'                  => trim($lit_type)
                );
                MediaCirculation::insert($data);
            } else {
                MediaCirculation::where(['Sole Media ID' => $od_mediaID, 'OD Media Type' => $media_category, 'OD Media ID' => $category->{'OD Media UID'}])->increment('Quantity', 1);
            }

            $assetID = DB::table($this->tableODLatlongDetail)->select('OD Asset ID as asset_id')->orderBy('OD Asset ID', 'desc')->first();
            $asset_ID = !empty($assetID) ? $assetID->asset_id + 1 : 1;

            return new ODLatLong([
                'OD Asset ID'          => $asset_ID,
                'OD Vendor ID'         => $od_mediaID,
                'Latitude'             => '',
                'Longitude'            => '',
                'Created DateTime'     => '',
                'Image File Name'      => '',
                'Remarks'              => '',
                'OD Media Type'        => trim($media_category),
                'Far Image File Name'  => '',
                'City'                 => '',
                'OD Media UID'         => trim($category->{'OD Media UID'}),
                'User ID'              => $userId,
                'Near Picture'         => null,
                'Far Picture'          => null,
                'Tag Name'             => '',
                'Rental'               => 0,
                'Rental Type'          => 0,
                'Illumination Type'    => trim($illumination_type),
                'Length'               => trim($rows['length']),
                'Width'                => trim($rows['width']),
                'Total Area'           => trim($rows['length'] * $rows['width']),
                'Size Type'            => 0,
                'Lit Type'             => trim($lit_type),
                'Location Name'        => trim($rows['location']),
                'Commercial Rate'      => trim($rows['rate_offered_to_cbc']),
                'Train Number'         => 0,
                'Train Name'           => '',
                'Categorization'       => trim($rows['categorization'])
            ]);
        // }
    }
}
