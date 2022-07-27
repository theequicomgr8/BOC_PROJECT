<?php
namespace App\Exports\Outdoor;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SoleRightMediaExcelExport implements WithMultipleSheets
{
    use Exportable;

    protected $excel_data_array; 
    protected $key_data;
    
    public function __construct($key_data, $excel_data_array)
    {
        $this->excel_data_array = $excel_data_array;
        $this->key_data = $key_data;
    }

    /**
     * @return array 
     */
    public function sheets(): array
    {
        $sheets = [];
        
        $sheetsArr = array('noOfSpotsArray','sizeArray','trainArray','sizeTrainArray','default');
            
        foreach ($sheetsArr as $key => $value) {
            if(in_array($value, $this->key_data)){
            $sheets[] = new SoleRightMediaSheet($key+1, $value, $this->excel_data_array);
            }
         }
         
        return $sheets;
    }
}