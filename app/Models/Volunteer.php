<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Volunteer extends Authenticatable
{
    use Notifiable;

    protected $table = 'volunteer_infos';
    protected $primaryKey = 'volunteer_id';

    protected $fillable = [
        'volunteer_id',
        'name',
        'email',
        'phone',
        'password',
        'status',
        'volunteer_notice',
    ];
}