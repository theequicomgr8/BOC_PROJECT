<?php

namespace App\Imports;

use App\Models\Api\ABCCirculation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Session;

class ABCExcelsImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $rows)
    {
        if ($rows['certificate'] == null && $rows['average_qualifying_circulation_jan_jun_2019'] == null && $rows['average_qualifying_circulation_jul_dec_2019'] == null && $rows['publication'] != '') {

            if ($rows['publication'] == 'DAILY  NEWSPAPERS' || $rows['publication'] == 'WEEKLY  NEWSPAPERS') {
                Session::put('newspaper_type', $rows['publication']);
            } else {
                Session::put('language', $rows['publication']);
            }
        }

        if (!empty($rows['certificate']) || !empty($rows['average_qualifying_circulation_jan_jun_2019']) || !empty($rows['average_qualifying_circulation_jul_dec_2019']) || !empty($rows['total_average_jan_jun_2019'])) {
            $av_cir_jan_jun = 0;
            $av_cir_jul_dec = 0;
            $status1 = '';
            $status2 = '';
            if (is_numeric($rows['average_qualifying_circulation_jan_jun_2019']) || is_numeric($rows['total_average_jan_jun_2019'])) {
                $av_cir_jan_jun = $rows['total_average_jan_jun_2019'] ?? $rows['average_qualifying_circulation_jan_jun_2019'];
            } else {
                $status1 = $rows['total_average_jan_jun_2019'] ?? $rows['average_qualifying_circulation_jan_jun_2019'];
            }

            if (is_numeric($rows['average_qualifying_circulation_jul_dec_2019']) || is_numeric($rows['total_average_jul_dec_2019'])) {
                $av_cir_jul_dec = $rows['total_average_jul_dec_2019'] ?? $rows['average_qualifying_circulation_jul_dec_2019'];
            } else {
                $status2 = $rows['total_average_jul_dec_2019'] ?? $rows['average_qualifying_circulation_jul_dec_2019'];
            }

            return new ABCCirculation([
                'Certificate No_'                        => trim($rows['certificate']) ?? '',
                'Newspaper Type'                         => trim(Session::get('newspaper_type')) ?? '',
                'Language'                               => trim(Session::get('language')) ?? '',
                'Average Circulation Jan - Jun 2019'     => trim($av_cir_jan_jun),
                'Status I'                               => trim($status1),
                'Publication Name'                       => trim($rows['publication']),
                'Edition Name'                           => trim($rows['edition'] ?? ''),
                'Average Circulation Jul - Dec 2019'     => trim($av_cir_jul_dec),
                'Status II'                              => trim($status2),
            ]);
        }
    }
}
