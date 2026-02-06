<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment_infos';
    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'team_name',
        'platform',
        'amount',
        'transaction_id',
        'payment_status'
    ];

    public function teamRegistration()
    {
        return $this->belongsTo(TeamRegistration::class, 'team_name', 'team_name');
    }
}
