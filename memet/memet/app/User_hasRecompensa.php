<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $correoUser
 * @property int $idRecompensa
 * @property User $user
 * @property Recompensa $recompensa
 */
class User_hasRecompensa extends Model
{
    protected $primaryKey = ['correoUser', 'idRecompensa'];
    public $incrementing = false;
    /**
     * @var array
     */
    protected $fillable = [];
    protected $table = 'user_has_recompensas';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'correoUser', 'correoUser');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recompensa()
    {
        return $this->belongsTo('App\Recompensa', 'idRecompensa');
    }
}
