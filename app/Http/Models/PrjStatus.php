<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PrjStatus extends Model
{
    protected $table = 'prjstatus';

    protected $primaryKey = 'prjs_id';

    protected $fillable = [
        'prjs_title'
    ];

    public $timestamps = false;

    public function projects()
    {
        return $this->hasMany(Projects::class, 'prj_status');
    }
}
