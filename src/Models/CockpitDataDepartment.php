<?php

namespace Goudenvis\CockpitData\Models;

use Illuminate\Database\Eloquent\Model;

class CockpitDataDepartment extends Model
{
    protected $table = 'cockpit_data_departments';

    protected $guarded = [];

    public $incrementing = false;

    protected $primaryKey = 'department_id';

    public function users()
    {
        return $this->belongsToMany(CockpitDataUser::class,
            'cockpit_data_department_user',
            'department_id',
            'user_id'
        );
    }
}
