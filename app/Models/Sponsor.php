<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $table = 'sponsor_infos';
    protected $primaryKey = 'sponsor_id';
    protected $fillable = [
        'name',
        'logo',
        'details',
        'sponsor_category',
        'link',
    ];
}
