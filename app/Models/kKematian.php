<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kKematian extends Model
{
    protected $table = 'kKematian';

    protected $fillable = [
        'kkID',
        'userID',
        'pictureIC',
        'status',
    ];
}
