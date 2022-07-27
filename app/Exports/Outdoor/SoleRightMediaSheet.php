<?php

namespace App\Exports\Outdoor;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class SoleRightMediaSheet implements WithTitle, WithHeadings, WithEvents
{
    private $number;
    private $head_key;
    private $excel_data_array;
    private $data = array();
    public function __construct(int $number, $head_key, $excel_data_array)
    {
        $this->number = $number;
        $this->head_key = $head_key;
        $this->excel_data_array = $excel_data_array;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'sheets ' . $this->number;
    }
    public function headings(): array
    {

        // excel header section
        $common_header_key = array('State', 'Category', 'Sub Category', 'Location','Length','Width','Categorization','Rate Offered to CBC');
        $header_insex = 0;

        foreach ($this->excel_data_array as $excel_datas) {
            if (array_key_exists($this->head_key, $excel_datas) === true) {

                // if (@$excel_datas[$this->head_key]['No Of Spots'] != '') {

                //     if (!in_array('No Of Spots', $common_header_key)) {
                //         array_push($common_header_key, 'No Of Spots');
                //     }

                //     if (!in_array('Illumination', $common_header_key)) {
                //         array_push($common_header_key, 'Illumination');
                //     }

                //     if ($excel_datas[$this->head_key]['Illumination'] != 'Non Lit') {
                //         if (!in_array('Lit Type', $common_header_key)) {
                //             array_push($common_header_key, 'Lit Type');
                //         }
                //     }
                // } else
                 if (@$excel_datas[$this->head_key]['Train Number'] != '' && @$excel_datas[$this->head_key]['Train Name'] != '' && @$excel_datas[$this->head_key]['Size Type'] == '') {

                    if (!in_array('Train Number', $common_header_key) && !in_array('Train Name', $common_header_key)) {
                        array_push($common_header_key, 'Train Number');
                        array_push($common_header_key, 'Train Name');
                    }

                    if (!in_array('Illumination', $common_header_key)) {
                        array_push($common_header_key, 'Illumination');
                    }

                    if ($excel_datas[$this->head_key]['Illumination'] != 'Non Lit') {
                        if (!in_array('Lit Type', $common_header_key)) {
                            array_push($common_header_key, 'Lit Type');
                        }
                    }
                } else if (@$excel_datas[$this->head_key]['Size Type'] != '' && @$excel_datas[$this->head_key]['Length'] != '' && @$excel_datas[$this->head_key]['Width'] != '' && @$excel_datas[$this->head_key]['Train Number'] == '') {

                    if (!in_array('Size Type', $common_header_key) && !in_array('Length', $common_header_key) && !in_array('Width', $common_header_key)) {
                        array_push($common_header_key, 'Size Type');
                        array_push($common_header_key, 'Length');
                        array_push($common_header_key, 'Width');
                    }

                    if (!in_array('Illumination', $common_header_key)) {
                        array_push($common_header_key, 'Illumination');
                    }

                    if ($excel_datas[$this->head_key]['Illumination'] != 'Non Lit') {
                        if (!in_array('Lit Type', $common_header_key)) {
                            array_push($common_header_key, 'Lit Type');
                        }
                    }
                } else if (@$excel_datas[$this->head_key]['Train Number'] != '' && @$excel_datas[$this->head_key]['Train Name'] != '' && @$excel_datas[$this->head_key]['Size Type'] != '' && @$excel_datas[$this->head_key]['Length'] != '' && @$excel_datas[$this->head_key]['Width'] != '') {

                    if (!in_array('Train Number', $common_header_key) && !in_array('Train Name', $common_header_key)) {
                        array_push($common_header_key, 'Train Number');
                        array_push($common_header_key, 'Train Name');
                    }

                    if (!in_array('Size Type', $common_header_key) && !in_array('Length', $common_header_key) && !in_array('Width', $common_header_key)) {
                        array_push($common_header_key, 'Size Type');
                        array_push($common_header_key, 'Length');
                        array_push($common_header_key, 'Width');
                    }

                    if (!in_array('Illumination', $common_header_key)) {
                        array_push($common_header_key, 'Illumination');
                    }

                    if ($excel_datas[$this->head_key]['Illumination'] != 'Non Lit') {
                        if (!in_array('Lit Type', $common_header_key)) {
                            array_push($common_header_key, 'Lit Type');
                        }
                    }
                } else {
                    if (!in_array('Illumination', $common_header_key)) {
                        array_push($common_header_key, 'Illumination');
                    }

                    if ($excel_datas[$this->head_key]['Illumination'] != 'Non Lit') {
                        if (!in_array('Lit Type', $common_header_key)) {
                            array_push($common_header_key, 'Lit Type');
                        }
                    }
                }
            }
        }
        if ($header_insex === 0) {
            array_push($this->data, $common_header_key);
        }
        $header_insex = 1;
        //end excel header section

        // excel value section
        foreach ($this->excel_data_array as $excel_datas) {
            $header_val = array();
            if (array_key_exists($this->head_key, $excel_datas) === true) {
                $qty_val = $excel_datas[$this->head_key]['Quantity'];
                for($i = 1; $i <= $qty_val; $i++){
                $header_val = array($excel_datas[$this->head_key]['State'], $excel_datas[$this->head_key]['Category'], $excel_datas[$this->head_key]['Sub Category'], '','','','','');

                // if (@$excel_datas[$this->head_key]['No Of Spots'] != '') {
                //     array_push($header_val, $excel_datas[$this->head_key]['No Of Spots']);

                //     if ($excel_datas[$this->head_key]['Illumination'] == 'Non Lit') {
                //         array_push($header_val, $excel_datas[$this->head_key]['Illumination']);
                //     } else {
                //         array_push($header_val, $excel_datas[$this->head_key]['Illumination']);
                //         array_push($header_val, $excel_datas[$this->head_key]['Lit Type']);
                //     }
                // } else
                 if (@$excel_datas[$this->head_key]['Train Number'] != '' && @$excel_datas[$this->head_key]['Train Name'] != '' && @$excel_datas[$this->head_key]['Size Type'] == '') {

                    array_push($header_val, $excel_datas[$this->head_key]['Train Number']);
                    array_push($header_val, $excel_datas[$this->head_key]['Train Name']);

                    if ($excel_datas[$this->head_key]['Illumination'] == 'Non Lit') {
                        array_push($header_val, $excel_datas[$this->head_key]['Illumination']);
                    } else {
                        array_push($header_val, $excel_datas[$this->head_key]['Illumination']);
                        array_push($header_val, $excel_datas[$this->head_key]['Lit Type']);
                    }
                } else if (@$excel_datas[$this->head_key]['Size Type'] != '' && @$excel_datas[$this->head_key]['Length'] != '' && @$excel_datas[$this->head_key]['Width'] != '' && @$excel_datas[$this->head_key]['Train Number'] == '') {

                    array_push($header_val, $excel_datas[$this->head_key]['Size Type']);
                    array_push($header_val, $excel_datas[$this->head_key]['Length']);
                    array_push($header_val, $excel_datas[$this->head_key]['Width']);

                    if ($excel_datas[$this->head_key]['Illumination'] == 'Non Lit') {
                        array_push($header_val, $excel_datas[$this->head_key]['Illumination']);
                    } else {
                        array_push($header_val, $excel_datas[$this->head_key]['Illumination']);
                        array_push($header_val, $excel_datas[$this->head_key]['Lit Type']);
                    }
                } else if (@$excel_datas[$this->head_key]['Train Number'] != '' && @$excel_datas[$this->head_key]['Train Name'] != '' && @$excel_datas[$this->head_key]['Size Type'] != '' && @$excel_datas[$this->head_key]['Length'] != '' && @$excel_datas[$this->head_key]['Width'] != '') {

                    array_push($header_val, $excel_datas[$this->head_key]['Train Number']);
                    array_push($header_val, $excel_datas[$this->head_key]['Train Name']);

                    array_push($header_val, $excel_datas[$this->head_key]['Size Type']);
                    array_push($header_val, $excel_datas[$this->head_key]['Length']);
                    array_push($header_val, $excel_datas[$this->head_key]['Width']);

                    if ($excel_datas[$this->head_key]['Illumination'] == 'Non Lit') {
                        array_push($header_val, $excel_datas[$this->head_key]['Illumination']);
                    } else {
                        array_push($header_val, $excel_datas[$this->head_key]['Illumination']);
                        array_push($header_val, $excel_datas[$this->head_key]['Lit Type']);
                    }
                } else {

                    if ($excel_datas[$this->head_key]['Illumination'] == 'Non Lit') {
                        array_push($header_val, $excel_datas[$this->head_key]['Illumination']);
                    } else {
                        array_push($header_val, $excel_datas[$this->head_key]['Illumination']);
                        array_push($header_val, $excel_datas[$this->head_key]['Lit Type']);
                    }
                }

                array_push($this->data, $header_val);
            }
        }
    }
        // end excel value section
        return $this->data;
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class  => function (AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('A1:M1')
                    ->getFont()
                    ->setBold(true);
            },
        ];
    }
}
