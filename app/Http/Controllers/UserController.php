<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        return view('profile');
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());

        $user->update([
            'login' => $request->login,
            'email' => $request->email,
            'name' => $request->name,
            'position' => $request->position,
        ]);

        createMsg(1, 'Данные обновлены');
        return back();
    }

    public function updatePassword(Request $request)
    {
        $user = User::find(Auth::id());

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            createMsg(0, 'Старый пароль введён неверно');
            return back();
        }

        $user->password = Hash::make($request->password);

        $user->update();

        createMsg(1, 'Пароль успешно изменён');
        return back();
    }
}
