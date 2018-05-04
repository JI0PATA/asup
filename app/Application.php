<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use function Sodium\compare;

class Application extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'place',
        'equipment',
        'comment',
        'call',
        'create_user_id',
        'created_at',
        'level'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'create_user_id', 'id');
    }

    public function engineer()
    {
        return $this->belongsTo('App\User', 'accept_user_id', 'id');
    }

    public function filterApplications(Request $request)
    {
        $applications = Application::orderBy('id', 'DESC')->where('level', '<>', 0);

        if (!empty($request->date_from)) {
            if (!empty($request->date_to))
                $applications->whereBetween('created_at', [format_date($request->date_from, 'Y-m-d 00:00:00'), format_date($request->date_to, 'Y-m-d 23:59:59')]);
            else
                $applications->whereBetween('created_at', [format_date($request->date_from, 'Y-m-d 00:00:00'), now()]);
        }
        elseif(!empty($request->date_to))
            $applications->whereBetween('created_at', [null, format_date($request->date_to, 'Y-m-d 23:59:59')]);

        if ($request->get('filter') === 'not-accept')
            $applications->where('accept_user_id', null);
        elseif ($request->get('filter') === 'complete')
            $applications->where('completed_at', '<>', null);

        $applications = $applications->get();

        $applications->map(function($item) {
            if ($item['accepted_at'] !== null && $item['completed_at'] !== null) {
                $d1 = new DateTime($item['accepted_at']);
                $d2 = new DateTime($item['completed_at']);

                $diff = $d2->diff($d1);
                $item['time'] = $diff->format('%h') * 60 + $diff->format('%i');
                return $item;
            }
        });

        $complete_time = 0;
        $complete_count = 0;

        foreach($applications as $application) {
            if ($application->time !== null) {
                $complete_time += $application->time;
                $complete_count++;
            }
        }

        if ($request->get('filter') !== 'not-accept')
            $avg_time = $complete_time / $complete_count;
        else
            $avg_time = '-';

        return [
            'applications' => $applications,
            'avg_time' => $avg_time,
        ];
    }
}
