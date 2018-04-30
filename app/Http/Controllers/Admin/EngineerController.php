<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class EngineerController extends Controller
{
    public function index()
    {
        $engineers = User::where('group_id', 2)->orderBy('id', 'DESC')->get();
        return view('modules.engineers.view', [
            'engineers' => $engineers
        ]);
    }

    public function add()
    {
        return view('modules.engineers.add');
    }

    public function create(Request $request)
    {
        User::create([
            'login' => $request->login,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'name' => $request->name,
            'position' => $request->position,
            'group_id' => 2
        ]);

        createMsg(1, 'Инженер успешно добавлен');
        return redirect()->route('admin.engineers');
    }

    public function edit($id)
    {
        $engineer = User::find($id);

        return view('modules.engineers.edit', [
            'engineer' => $engineer
        ]);
    }

    public function update(Request $request, $id)
    {
        $engineer = User::find($id);

        $engineer->update([
            'login' => $request->login,
            'email' => $request->email,
            'name' => $request->name,
            'position' => $request->position,
        ]);

        createMsg(1, 'Данные отредактированы');
        return redirect()->back();
    }

    public function updatePassword(Request $request, $id)
    {
        $engineer = User::find($id);

        if (!Hash::check($request->old_password, $engineer->password)) {
            createMsg(0, 'Старый пароль введён неверно!');
            return redirect()->back();
        }

        $engineer->password = Hash::make($request->password);

        $engineer->update();

        createMsg(1, 'Пароль успешно сменён');
        return redirect()->back();
    }
}
