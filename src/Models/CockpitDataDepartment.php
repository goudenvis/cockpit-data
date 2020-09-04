<?php

namespace Goudenvis\CockpitData\Models;

use Illuminate\Database\Eloquent\Model;

class CockpitDataDepartment extends Model
{
    protected $table = 'cockpit_data_departments';

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(CockpitDataUser::class,
            'department_user',
            'department_id',
            'user_id'
        );
    }
}
