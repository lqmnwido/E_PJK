<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenazah extends Model
{
    protected $fillable = [
        'jenazahID',
        'userID',
        'locationID',
        'deathDate',
        'permit',
        'graveLot',
        'status',
    ];
}
