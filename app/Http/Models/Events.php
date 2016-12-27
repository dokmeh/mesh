<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'events';

    protected $primaryKey = 'eve_id';

    protected $fillable = [
        'eve_title',
        'eve_url',
        'eve_text',
        'eve_date',
        'eve_sort'
    ];

    public $timestamps = false;
}
