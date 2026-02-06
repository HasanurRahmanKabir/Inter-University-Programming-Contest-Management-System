<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rules extends Model
{
    protected $table = 'rules';
    protected $primaryKey = 'rules_id';
    protected $fillable = [
        'rules_headline',
        'rules_description',
        'is_published',
    ];
}
