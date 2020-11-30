<?php

namespace Goudenvis\CockpitData\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CockpitDataVacancy extends Model
{
    protected $table = 'cockpit_data_vacancies';

    protected $guarded = [];

    public $casts = [
        'datetime_created' => 'datetime'
    ];

    public function stateTransitions()
    {
        return $this->hasMany(
            CockpitDataVacancyStateTransition::class,
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

    public function matches()
    {
        return $this->hasMany(
            CockpitDataMatch::class,
            'vacancy_id',
            'vacancy_id'
        );
    }

    public function owner()
    {
        return $this->belongsTo(
            CockpitDataUser::class,
            'owner_id',
            'user_id'
        );
    }

    public function company()
    {
        return $this->belongsTo(
            CockpitDataCompany::class,
            'company_id',
            'company_id'
        );
    }

    public function hasState(Carbon $date, $state): bool
    {
        $stateTransitions = $this->stateTransitions->sortByDesc('datetime_created');

        $stateTransitionBeforeDate = $stateTransitions->where('datetime_created', '<', $date->endOfDay());

        if ($stateTransitionBeforeDate->count() == 0) {
            return false;
        } elseif ($stateTransitionBeforeDate->where('datetime_created', '=', $date)->count() > 1) {
            return $stateTransitionBeforeDate->where('datetime_created', '=', $date)
                    ->where('after_state', $state)
                    ->count() > 0;
        }
        return  $stateTransitionBeforeDate->first()->after_state == $state;
    }

    public function isOnline(Carbon $date): bool
    {
        return $this->hasState($date, 'Online');
    }

    public function isNotOnline(Carbon $date): bool
    {
        return !$this->isOnline($date);
    }

    public function isInactive(Carbon $date): bool
    {
        return $this->hasState($date, 'Inactief');
    }

    public function isNotInactive(Carbon $date): bool
    {
        return !$this->isInactive($date);
    }

    public function getState(Carbon $date): string
    {
        $stateTransitions = $this->stateTransitions->sortByDesc('datetime_created');

        $stateTransitionBeforeDate = $stateTransitions->where('datetime_created', '<', $date->endOfDay());

        if ($stateTransitionBeforeDate->count() == 0) {
            return false;
        } elseif ($stateTransitionBeforeDate->where('datetime_created', '=', $date)->count() > 1) {
            return $stateTransitionBeforeDate->where('datetime_created', '=', $date)
                    ->count() > 0;
        }
        return  $stateTransitionBeforeDate->first()->after_state;
    }
}
