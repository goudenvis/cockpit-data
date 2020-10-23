<?php

namespace Goudenvis\CockpitData\Models;

use Illuminate\Database\Eloquent\Model;

class CockpitDataCandidate extends Model
{
    protected $table = 'cockpit_data_candidates';

    protected $guarded = [];

    public function matches()
    {
        return $this->hasMany(
            CockpitDataMatch::class,
            'candidate_id',
            'candidate_id'
        );
    }

    public function stateTransitions()
    {
        return $this->hasMany(
            CockpitDataCandidateStateTransition::class,
            'candidate_id',
            'candidate_id'
        );
    }
}
