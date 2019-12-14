<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Mission
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $complete_message
 * @property int $reward_trust
 * @property int $reward_credits
 * @property int $corp_id
 * @property string $type
 * @property string $objective
 * @property int $minimum_trust
 * @property int $hidden
 * @property int $reward_item_id
 * @property int|null $chain_parent
 * @property-read \App\Models\Corporation $corporation
 * @property-read \App\Models\Mission $parent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mission query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mission whereChainParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mission whereCompleteMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mission whereCorpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mission whereHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mission whereMinimumTrust($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mission whereObjective($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mission whereRewardCredits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mission whereRewardTrust($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mission whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mission whereType($value)
 * @mixin \Eloquent
 */
class Mission extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title', 'description', 'complete_message', 'reward_trust', 'reward_credits', 'reward_item_id','corp_id',
        'type', 'objective', 'minimum_trust', 'hidden', 'chain_parent'
    ];

    public function corporation()
    {
        return $this->hasOne(Corporation::class, 'id', 'corp_id');
    }

    public function parent()
    {
        return $this->hasOne(Mission::class, 'id', 'chain_parent');
    }

    public function rewardItem()
    {
        return $this->hasOne(RewardItem::class, 'id', 'reward_item_id');
    }
}
