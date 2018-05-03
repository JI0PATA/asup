<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ResetPassword extends Controller
{
    public function view()
    {
        return view('auth.resetPassword');
    }

    public function reset(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            createMsg(0, 'Такого пользователя не существует');
            return back();
        }

        $newPassword = random_int(10000, 99999);

        $user->password = Hash::make($newPassword);

        $user->update();

        mail($request->email, 'Восстановление пароля', 'Ваш логин: '.$user->login.'\nВаш новый пароль: '.$newPassword.'\nВы можете сменить пароль в Личном кабинете');
        createMsg(1, 'Новый пароль выслан на почту');
        return redirect()->route('login');
    }
}
