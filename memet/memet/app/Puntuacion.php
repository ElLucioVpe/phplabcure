<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $User_correoUser
 * @property int $Meme_idMeme
 * @property boolean $valorPuntuacion
 * @property Meme $meme
 * @property User $user
 */
class Puntuacion extends Model
{
    protected $primaryKey = ['User_correoUser', 'Meme_idMeme'];
    public $incrementing = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'puntuacion';

    /**
     * @var array
     */
    protected $fillable = ['User_correoUser', 'Meme_idMeme', 'valorPuntuacion'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function meme()
    {
        return $this->belongsTo('App\Meme', 'Meme_idMeme', 'idMeme');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'User_correoUser', 'correoUser');
    }

    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery(Builder $query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    /**
     * Get the primary key value for a save query.
     *
     * @param mixed $keyName
     * @return mixed
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }
}
