<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Postdata;

class PostController extends Controller
{
    //
    public function index()
    {
        $post = Postdata::all();
        if($post->count() > 0){
            return response()->json([
                'Status' => 200,
                'Data' => $post
            ],200);
        }else{
            return response()->json([
                'Status' => 404,
                'Message' => "No Record Found"
            ],404);
        }
        
        
        
    }
}
