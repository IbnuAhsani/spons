<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_User extends Model
{
    protected $table='event_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_confirmation_status', 'company_confirmation_status', 'student_id', 'user_id', 'event_id',
    ];

    public function document(){
        return $this->belongsTo('App\Document');
    }
}
