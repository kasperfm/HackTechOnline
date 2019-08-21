<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MissionData
 *
 * @property int $id
 * @property int $mission_id
 * @property string $event_type
 * @property string $event_param
 * @property string $event_action
 * @property-read \App\Models\Mission $mission
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MissionData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MissionData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MissionData query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MissionData whereEventAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MissionData whereEventParam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MissionData whereEventType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MissionData whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MissionData whereMissionId($value)
 * @mixin \Eloquent
 */
class MissionData extends Model
{
    protected $table = 'mission_datas';
    protected $fillable = [
        'mission_id', 'event_type', 'event_param', 'event_action'
    ];
    public $timestamps = false;

    public function mission()
    {
        return $this->hasOne(Mission::class, 'id', 'mission_id');
    }
}
