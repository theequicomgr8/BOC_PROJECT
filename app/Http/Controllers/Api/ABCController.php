<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\ABCCirculation;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ABCExcelsImport;
use App\Http\Traits\CommonTrait;

class ABCController extends Controller
{
    use CommonTrait;
    /** 
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function excelImport(Request $request)
    {
        try {
            Excel::import(new ABCExcelsImport, request()->file('file'));
            return $this->sendResponse('', 'Data retrieved successfully');
        } catch (ValidationException $ex) {
 
            $failures = $ex->failures();
            foreach ($failures as $failure) {
                return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
            }
        }
    }
}
