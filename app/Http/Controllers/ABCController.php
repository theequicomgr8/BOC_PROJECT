<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Controllers\Api\ABCController as api;

class ABCController extends Controller
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function importABCView()
    {
        return view('admin.pages.print.abc-excel-import-form');
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);
        $resp = (new api)->excelImport($request);
        $response = json_decode(json_encode($resp), true);
        if ($response['original']['success'] == true) {
            return back()->with('success', 'Data imported successfully!');
        } else {
            return back()->with('fails', 'toast_error');
        }
    }
}
