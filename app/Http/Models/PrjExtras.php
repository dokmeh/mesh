<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PrjExtras extends Model
{
    protected $table = 'prjextras';

    protected $primaryKey = 'prje_id';

    protected $fillable = [
        'prje_title',
        'prje_content',
        'prj_id'
    ];

    public $timestamps = false;

    public function project()
    {
        return $this->belongsTo(Projects::class, 'prj_id');
    }
}
