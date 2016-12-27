<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PrjAwards extends Model
{
    protected $table = 'prjawards';

    protected $primaryKey = 'prja_id';

    protected $fillable = [
        'prja_title',
        'prj_id'
    ];

    public $timestamps = false;

    public function project()
    {
        return $this->belongsTo(Projects::class, 'prj_id');
    }
}
