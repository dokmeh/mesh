<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PrjCategory extends Model
{
    protected $table = 'prjcategory';

    protected $primaryKey = 'prjc_id';

    protected $fillable = [
        'prjc_title'
    ];

    public $timestamps = false;

    public function projects()
    {
        return $this->hasMany(Projects::class, 'prj_category');
    }
}
