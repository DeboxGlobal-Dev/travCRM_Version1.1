<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;//

class CompanyController extends Controller
{
    public function healthCheck()
    {
        return response()->json(['status' => true]);
    }
}
//
