<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserApp
 *
 * @property int $id
 * @property int $user_id
 * @property int $application_id
 * @property int $installed
 * @property int $application_datas_id
 * @property-read \App\Models\Application $app
 * @property-read \App\Models\ApplicationData $data
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserApp byVersion($version)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserApp currentVersionOf($appId)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserApp installed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserApp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserApp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserApp ownedBy($owner)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserApp query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserApp whereApplicationDatasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserApp whereApplicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserApp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserApp whereInstalled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserApp whereUserId($value)
 * @mixin \Eloquent
 */
class UserApp extends Model
{
    protected $table = 'user_apps';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'application_id', 'installed', 'application_datas_id'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function application(){
        //$appData = ApplicationData::where('id', $this->application_id)->first();
        $application = Application::where('id', $this->application_id)->first();
        return $application;
    }

    public function app(){
        return $this->hasOne('App\Models\Application', 'id', 'application_id');
    }

    public function data(){
        return $this->hasOne('App\Models\ApplicationData', 'id', 'application_datas_id');
    }

    public function scopeInstalled($query){
        return $query->where('installed', 1);
    }

    public function scopeOwnedBy($query, $owner){
        return $query->where('user_apps.user_id', $owner);
    }

    public function scopeCurrentVersionOf($query, $appId){
        return $query->join('application_datas', 'application_datas.id', '=', 'user_apps.application_datas_id')->select('user_apps.*', 'version')->where('user_apps.application_id', $appId)->orderBy('version', 'desc')->limit(1);
    }

    public function scopeByVersion($query, $version){
        return $query->join('application_datas', 'application_datas.id', '=', 'user_apps.application_id')->select('user_apps.*', 'version')->where('application_datas.version', '=', $version);
    }
}
