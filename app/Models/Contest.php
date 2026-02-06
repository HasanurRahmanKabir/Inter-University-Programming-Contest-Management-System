<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    protected $table = 'contest_infos';
    protected $primaryKey = 'contest_id';
    protected $fillable = [
        'contest_id',
        'title',
        'description',
        'contest_start_date',
        'contest_end_date',
        'registration_start_date',
        'registration_end_date',
        'status',
    ];
}
