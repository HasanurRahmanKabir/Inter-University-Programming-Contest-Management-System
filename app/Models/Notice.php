<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $table = 'notices';
    protected $primaryKey = 'notice_id';
    protected $fillable = [
        'notice_id',
        'title',
        'description',
        'audience',
        'notice_date',
        'status',
    ];
}
