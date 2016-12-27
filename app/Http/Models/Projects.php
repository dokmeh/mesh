<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $table = 'projects';

    protected $primaryKey = 'prj_id';

    protected $fillable = [
        'prj_name',
        'prj_url',
        'prj_category',
        'prj_location',
        'prj_client',
        'prj_status',
        'prj_ddate',
        'prj_cdate',
        'prj_sarea',
        'prj_farea',
        'prj_desc',
        'prj_sort'
    ];

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(PrjCategory::class, 'prj_category');
    }

    public function status()
    {
        return $this->belongsTo(PrjStatus::class, 'prj_status');
    }

    public function extras()
    {
        return $this->hasMany(PrjExtras::class, 'prj_id');
    }

    public function awards()
    {
        return $this->hasMany(PrjAwards::class, 'prj_id');
    }

    public function press()
    {
        return $this->hasMany(PrjPress::class, 'prj_id');
    }

    public function links()
    {
        return $this->hasMany(PrjLinks::class, 'prj_id');
    }
}
