<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'userName';
    protected $keyType = 'string';

    protected $fillable = [
        'userName',
        'email',
        'userType',
        'password'
    ];
}
