<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientSubAdvertisementController extends Controller
{
    public function ClientSubAdvertisement(){
        return view('admin.pages.client-submission-for-advertisement');
    }
}
