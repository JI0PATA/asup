<?php

namespace App\Http\Controllers;

use App\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{

    public function newApplications()
    {
        $newApplications = Application::with('user')->where('level', 0)->orderBy('id', 'DESC')->get();

        return view('admin.index', [
            'applications' => $newApplications
        ]);
    }

    /**
     * Создание заявки
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        Application::create([
            'place' => $request->place,
            'equipment' => $request->equipment,
            'comment' => $request->comment,
            'create_user_id' => Auth::id(),
            'created_at' => now()
        ]);

        createMsg(1, 'Ваша заявка создана');
        return redirect()->route('home');
    }

    public function view($id)
    {
        $application = Application::with('user')->find($id);

        return view('modules.applications.view', [
            'application' => $application,
        ]);
    }

    public function updateApplication(Request $request, $id)
    {
        $application = Application::find($id);

        $application->update([
            'level' => $request->level
        ]);

        createMsg(1, 'Вы установили сложность');

        return redirect()->route('admin.index');
    }

    public function getApplications()
    {
        $applications = Application::with(['user', 'engineer'])->where('level', '<>', 0)->orderBy('id', 'DESC')->get();

        return view('admin.applications', [
            'applications' => $applications
        ]);
    }

    public function getApplication($id)
    {
        $application = Application::with(['user', 'engineer'])->find($id);

        return view('admin.application', [
            'application' => $application,
        ]);
    }

    public function deleteApplication($id)
    {
        $application = Application::find($id);

        $application->delete();

        createMsg(1, 'Заявка удалена');
        return back();
    }
}
