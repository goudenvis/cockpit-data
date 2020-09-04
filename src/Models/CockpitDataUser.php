<?php

namespace Goudenvis\CockpitData\Models;

use Illuminate\Database\Eloquent\Model;

class CockpitDataUser extends Model
{
    protected $table = 'cockpit_data_users';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(CockpitDataUser::class, 'cockpit_user_id', 'user_id');
    }

    public function getFullnameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function baseUser()
    {
        return $this->belongsTo(CockpitDataUser::class, 'users.cockpit_user_id');
    }

    public function departments()
    {
        $relation = $this->belongsToMany(
            CockpitDataDepartment::class,
            'department_user',
            'user_id',
            'department_id'
        );

        return $relation;
    }

    public function hasDepartment(CockpitDataDepartment $department)
    {
        return $this->departments->contains($department);
    }
}
