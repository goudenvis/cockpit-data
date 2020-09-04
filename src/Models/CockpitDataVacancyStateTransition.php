<?php

namespace Goudenvis\CockpitData\Models;

use Illuminate\Database\Eloquent\Model;

class CockpitDataVacancyStateTransition extends Model
{
    protected $table = 'cockpit_data_vacancy_state_transitions';

    protected $guarded = [];

    public $casts = [
        'datetime_created' => 'datetime'
    ];

    public function vacancy()
    {
        return $this->belongsTo(CockpitDataVacancy::class, 'vacancy_id','vacancy_id');
    }

    public function author()
    {
        return $this->belongsTo(CockpitDataUser::class, 'author_id', 'user_id');
    }
}
