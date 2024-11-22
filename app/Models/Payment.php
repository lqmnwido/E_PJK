<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';

    protected $fillable = [
        'paymentID',
        'userID',
        'services',
        'amount',
        'typeOfPayment',
        'status',
        'receipt',

    ];
}

