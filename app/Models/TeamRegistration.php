<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TeamRegistration extends Authenticatable
{
    use Notifiable;

    protected $table = 'team_registration_infos';
    protected $primaryKey = 'team_id';
    public $timestamps = true;

    protected $fillable = [
        'team_id',
        'team_name',
        'institute_name',
        'password',
        'coach_name',
        'coach_email',
        'coach_phone',
        'coach_photo',
        'coach_t_shirt',
        'mem_1_name',
        'mem_1_student_id',
        'mem_1_email',
        'mem_1_phone',
        'mem_1_t_shirt',
        'mem_1_photo',
        'mem_2_name',
        'mem_2_student_id',
        'mem_2_email',
        'mem_2_phone',
        'mem_2_t_shirt',
        'mem_2_photo',
        'mem_3_name',
        'mem_3_student_id',
        'mem_3_email',
        'mem_3_phone',
        'mem_3_t_shirt',
        'mem_3_photo',
        'is_paid',
        'is_selected',
    ];
}