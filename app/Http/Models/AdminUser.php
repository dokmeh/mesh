<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'uid';
    protected $fillable = [
        'upass'
    ];
    public $timestamps = false;
}
