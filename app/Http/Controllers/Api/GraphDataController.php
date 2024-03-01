<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GraphDataController extends Controller
{
    public function data1(){
        return [100, 230, 130, 140, 270, 140,83];
    }
}
