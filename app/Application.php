<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
