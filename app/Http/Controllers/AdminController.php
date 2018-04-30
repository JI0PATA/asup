<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function logout()
    {
        session()->forget('admin');
        return redirect()->route('home');
    }
}
