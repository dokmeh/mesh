<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PrjPress extends Model
{
    protected $table = 'prjpress';

    protected $primaryKey = 'prjp_id';

    protected $fillable = [
        'prjp_title',
        'prj_id'
    ];

    public $timestamps = false;

    public function project()
    {
        return $this->belongsTo(Projects::class, 'prj_id');
    }
}
