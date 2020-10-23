<?php

namespace Goudenvis\CockpitData\Models;

use Illuminate\Database\Eloquent\Model;

class CockpitDataMatchStateTransition extends Model
{
    protected $table = 'cockpit_data_match_state_transitions';

    protected $guarded = [];

    public function match()
    {
        return $this->belongsTo(
            CockpitDataMatch::class,
            'match_id',
            'match_id'
        );
    }

    public function author()
    {
        return $this->belongsTo(
            CockpitDataUser::class,
            'author_id',
            'user_id'
        );
    }
}
