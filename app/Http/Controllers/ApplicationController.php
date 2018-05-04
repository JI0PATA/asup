<?php

namespace App\Http\Controllers;

use App\Application;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'call' => $request->call,
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

    public function getApplications(Request $request)
    {
        $filterApplications = (new \App\Application)->filterApplications($request);


        return view('admin.applications', [
            'applications' => $filterApplications['applications'],
            'avg_time' => $filterApplications['avg_time']
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

    public function downloadExcel(Request $request)
    {
        $filterApplications = (new \App\Application)->filterApplications($request);

        $applications = $filterApplications['applications'];

        $csv = [
            '№',
            'Номер аудитории',
            'Оборудование',
            'Комментарий',
            'Телефон',
            '',
            'ФИО',
            'E-mail',
            '',
            'Сложность',
            'Статус',
            'Техник',
            'Время создания',
            'Время принятия',
            'Время завершения',
            'Время выполнения'
        ];

        $handle = fopen(storage_path('app/excel/excel.csv'), 'w');

        fputcsv($handle, $csv, ';');

        foreach ($applications as $application) {

            $list = [
                $application->id,
                $application->place,
                $application->equipment,
                $application->comment,
                '="'.$application->call.'"',
                '',
                $application->user->name,
                $application->user->email,
                '',
                $application->level.' уровень',
                $application['accept_user_id'] === null ? 'Ожидается' : ($application['completed_at'] === null ? 'Выполняется' : 'Выполнено'),
                $application['accept_user_id'] === null ? '-' : $application['engineer']['name'],
                format_date($application->created_at),
                format_date($application->accepted_at),
                format_date($application->completed_at),
                calc_time($application->time)
            ];

            fputcsv($handle, $list, ';');
        }

        $file_csv = file_get_contents(storage_path('app/excel/excel.csv'));
        $file_csv = iconv('utf-8', 'windows-1251', $file_csv);

        file_put_contents(storage_path('app/excel/excel.csv'), '');
        fwrite($handle, $file_csv);
        fclose($handle);
    }
}
