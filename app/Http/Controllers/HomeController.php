<?php

namespace App\Http\Controllers;

use App\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = Application::with('user')->where('create_user_id', Auth::id())->orderBy('id', 'DESC')->get();

        return view('index', [
            'applications' => $applications
        ]);
    }

    public function showRequestFormAdd()
    {
        return view('modules.applications.add');
    }
}
