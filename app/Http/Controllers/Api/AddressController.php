<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country; 

class AddressController extends Controller
{

    public $successStatus = 200;

    // Get Member List
    public function getCountry(Request $request)
    {
       $list =Country::select('name')
       ->get();
       return response()->json(["message" => "Country List", 'list' => $list, $this-> successStatus]);
    }
}
