<?php

namespace App\Http\Controllers\Auth;


use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param Request $request
     * @return Request|\Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        if ($request['password'] !== $request['conf-password']) return createMsg(0, 'Пароли не совпадают');

        if ($request['key'] !== 'ktits2018') return createMsg(0, 'Неверный код!');

        try {
            User::create([
                'login' => $request['login'],
                'password' => Hash::make($request['password']),
                'email' => $request['email'],
                'name' => $request['name'],
                'position' => $request['position'],
                'group_id' => $request['group_id'],
            ]);
        } catch (\Exception $exception) {
            createMsg(0, 'Регистрация не завершена. Возможно, такой логин или e-mail уже существуют');
            return back();
        }

        createMsg(1, 'Вы успешно зарегистрированы!', route('login'));
        return redirect()->route('login');
    }
}
