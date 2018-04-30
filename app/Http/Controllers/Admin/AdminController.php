<?php

namespace App\Http\Controllers\Admin;

use App\Application;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function logout()
    {
        session()->forget('admin');
        return redirect()->route('home');
    }

    public function getUsers()
    {
        $users = User::where('group_id', 1)->get();
        return view('modules.users.index', [
            'users' => $users
        ]);
    }
}
