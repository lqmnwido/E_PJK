<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kKematian extends Model
{
    protected $table = 'khairat_kematian';

    protected $fillable = [
        'kkID',
        'userID',
        'pictureIC',
        'status',
    ];
}
