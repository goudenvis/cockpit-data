<?php

namespace Goudenvis\CockpitData\Models;

use Illuminate\Database\Eloquent\Model;

class CockpitDataTask extends Model
{
    protected $table = 'cockpit_data_tasks';

    protected $guarded = [];

    public function owner()
    {
        return $this->belongsTo(
            CockpitDataUser::class,
            'owner_id',
            'user_id'
        );
    }

    public function ownerDepartment()
    {
        return $this->belongsTo(
            CockpitDataDepartment::class,
            'owner_department_id',
            'department_id'
        );
    }
}
