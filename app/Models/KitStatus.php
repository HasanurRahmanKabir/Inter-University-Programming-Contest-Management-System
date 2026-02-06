<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KitStatus extends Model
{
    protected $table = 'kit_statuses';
    protected $primaryKey = 'kit_id';
    protected $fillable = [
        'kit_id',
        'team_id',
        'kit_received',
        'received_date',
        'comments',
    ];
}
