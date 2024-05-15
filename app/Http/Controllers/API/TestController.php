<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class TestController extends Controller
{
    public function index(){
        $data = Banner::all();
        foreach($data as $key => $item){
            $data[$key]['media'] = $item->getFirstMediaUrl('banner');
        }
        // echo count($data);
        return response()->json($data);
    }
}
