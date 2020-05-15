<?php

namespace App;

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
}
