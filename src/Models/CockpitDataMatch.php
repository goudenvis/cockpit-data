<?php

namespace Goudenvis\CockpitData\Models;

use Illuminate\Database\Eloquent\Model;

class CockpitDataMatch extends Model
{
    protected $table = 'cockpit_data_matches';

    protected $guarded = [];

    public function matchTransitions()
    {
        return $this->hasMany(
            CockpitDataMatchStateTransition::class,
            'match_id',
            'match_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            CockpitDataUser::class,
            'owner_id',
            'user_id'
        );
    }

    public function candidate()
    {
        return $this->belongsTo(
            CockpitDataCandidate::class,
            'candidate_id',
            'candidate_id'
        );
    }

    public function vacancy()
    {
        return $this->belongsTo(
            CockpitDataVacancy::class,
            'vacancy_id',
            'vacancy_id'
        );
    }

    public function department()
    {
        return $this->belongsTo(
            CockpitDataDepartment::class,
            'owner_department_id',
            'department_id'
        );
    }
}
