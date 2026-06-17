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
        'user_id',
        'noIC',
        'DOB',
        'nationality',
        'race',
        'gender',
        'phone',
        'address',
        'heir',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
