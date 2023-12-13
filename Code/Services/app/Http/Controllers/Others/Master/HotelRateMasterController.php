<?php

namespace App\Http\Controllers\Others\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Others\Master\HotelRateMaster;

class HotelRateMasterController extends Controller
{
    public function index(Request $request){
       $message = HotelRateMaster::HotelList($request);
       echo $message;
    }

    public function store(Request $request){

    }
}
