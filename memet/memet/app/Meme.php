<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idMeme
 * @property string $tituloMeme
 * @property string $fechaMeme
 * @property string $rutaMeme
 * @property string $User_correoUser
 * @property User $user
 * @property Puntuacion[] $puntuacions
 * @property Tag[] $tags
 */
class Meme extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'meme';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idMeme';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['fechaMeme', 'rutaMeme', 'User_correoUser'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'User_correoUser', 'correoUser');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function puntuacions()
    {
        return $this->hasMany('App\Puntuacion', 'Meme_idMeme', 'idMeme');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'tag_has_meme', 'Meme_idMeme', 'Tag_nombreTag');
    }
}
