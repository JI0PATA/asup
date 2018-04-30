<?php

namespace App\Http\Controllers\Engineer;

use App\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        $applications = Application::orderBy('id', 'DESC')->get();

        return view('engineer.index', [
            'applications' => $applications
        ]);
    }

    public function accept($id)
    {
        $application = Application::find($id);

        $application->accept_user_id = Auth::id();
        $application->accepted_at = now();

        $application->update();

        createMsg(1, 'Вы приняли заявку');
        return redirect()->back();
    }

    public function complete($id)
    {
        $application = Application::find($id);

        $application->completed_at = now();
        $application->update();

        createMsg(1, 'Вы завершили задачу');
        return redirect()->back();
    }

    public function resume($id)
    {
        $application = Application::find($id);

        $application->completed_at = null;

        $application->update();

        createMsg(1, 'Вы возобновили задачу');
        return redirect()->back();
    }

    public function cancel($id)
    {
        $application = Application::find($id);

        $application->accept_user_id = null;
        $application->accepted_at = null;

        $application->update();

        createMsg(1, 'Вы отказались от задачи');
        return redirect()->back();
    }

    public function myApplications()
    {
        $applications = Application::with(['user', 'engineer'])->where('accept_user_id', Auth::id())->get();

        return view('engineer.myApplication', [
            'applications' => $applications
        ]);
    }
}
