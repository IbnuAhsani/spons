<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'date', 'location', 'description', 'type', 'category', 'proposal', 'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function eventType(){
        return $this->belongsTo('App\EventType');
    }

    public function eventCategory(){
        return $this->belongsTo('App\EventCategory');
    }
}
