<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PrjLinks extends Model
{
    protected $table = 'prjlinks';

    protected $primaryKey = 'prjl_id';

    protected $fillable = [
        'prjl_title',
        'prjl_url',
        'prj_id'
    ];

    public $timestamps = false;

    public function project()
    {
        return $this->belongsTo(Projects::class, 'prj_id');
    }
}
