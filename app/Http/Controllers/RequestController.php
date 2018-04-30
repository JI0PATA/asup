<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function newRequests()
    {
        return view('admin.index');
    }
}
