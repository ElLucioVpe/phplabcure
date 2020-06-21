<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $nivel
 * @property string $tipo
 * @property string $contenido
 * @property User[] $users
 */
class Recompensa extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nivel', 'tipo', 'contenido'];
    protected $table = 'recompensa';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_has_recompensas', 'idRecompensa', 'correoUser');
    }
}
