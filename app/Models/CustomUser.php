<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomUser extends Authenticatable
{
    use HasFactory;

    protected $connection = 'mysqlDtr'; // Use the custom connection
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $fillable = [
        'username', 'password', 'usertype'
        // Add other fields as needed
    ];

    // Hide password from JSON serialization
    protected $hidden = [
        'password',
    ];
}
