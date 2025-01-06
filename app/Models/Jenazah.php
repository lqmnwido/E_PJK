<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenazah extends Model
{

    protected $table = 'jenazah';

    protected $fillable = [
        'jenazahID',
        'userID',
        'jenazahIC',
        'jenazahName',
        'jenazahGender',
        'jenazahDOB',
        'jenazahBangsa',
        'jenazahWarga',
        'locationID',
        'deathDate',
        'permit',
        'graveLot',
        'status',
    ];
}
