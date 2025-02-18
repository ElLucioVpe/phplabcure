<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravelista\Comments\Commenter;


/**
 * @property string $correoUser
 * @property string $nickUser
 * @property int $experienciaUser
 * @property string $passwordUser
 * @property string $tipoUser
 * @property int $nivelUser
 * @property string $avatarUser
 * @property Meme[] $memes
 * @property Puntuacion[] $puntuacions
 * @property Suscripcion[] $suscripcions
 */
class User extends Authenticatable
{
    use Commenter;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'user';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'correoUser';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['nickUser', 'passwordUser', 'tipoUser', 'nivelUser', 'avatarUser'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function memes()
    {
        return $this->hasMany('App\Meme', 'User_correoUser', 'correoUser');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function puntuacions()
    {
        return $this->hasMany('App\Puntuacion', 'User_correoUser', 'correoUser');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function suscripcions()
    {
        return $this->hasMany('App\Suscripcion', 'User_correoUser', 'correoUser');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function recompensas()
    {
        return $this->belongsToMany('App\Recompensa', 'user_has_recompensas', 'correoUser', 'idRecompensa');
    }

    //Specific Column Password Auth
    public function getAuthPassword()
    {
        return $this->passwordUser;
    }
}
