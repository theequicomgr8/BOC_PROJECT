<?php

namespace App\Imports\Outdoor\Media;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class SoleRightMediaSheets implements WithMultipleSheets,SkipsUnknownSheets
{

    public function sheets(): array
    {
        return [
            'sheets 1' => new FirstSheetImport(),
            'sheets 2' => new SecondSheetImport(),
            'sheets 3' => new ThirdSheetImport(),
            'sheets 4' => new ForthSheetImport(),
            'sheets 5' => new FifthSheetImport(),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}
