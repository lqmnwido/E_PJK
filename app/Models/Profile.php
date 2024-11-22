<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'profile';

    protected $fillable = [
        'profileID',
        'userID',
        'noIC',
        'DOB',
        'nationality',
        'race',
        'gender',
        'address',
        'heir',
    ];
}
