<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Master\CreateUpdateUser;

class AuthoriseUserController extends Controller
{
    public function authenticate(Request $request)
    {
        
        $userId = $request->input('UserId');
        $password = $request->input('Password');
        $action = $request->input('Action');

        $posts = CreateUpdateUser::select('CompanyKey', 'UserKey')
        ->where('Email', $userId)
        ->where('Password', $password)
        ->get();
        if ($posts->count() > 0) {
            $response = Http::post('https://travcrm.in/Stratos/api/authoriseUser.php', [
                'COMPANYKEY' => $posts[0]->CompanyKey,
                'USERKEY' => $posts[0]->UserKey,
                'ACTION' => $action
            ]);
             $data = $response->json();

             if($data['STATUSID'] == 0){

                    return response()->json([
                    'Status' => "0",
                    'Message' => "User Matched"
                ]);
             }else{

                return response()->json([
                    'Status' => "-1",
                    'Message' => "User not Matched"
                ]);

             }  
        } else {
            
{}            return response()->json([
                'Status' => "-1",
                'Message' => "User not Matched"
            ]);
        }
    }

}
