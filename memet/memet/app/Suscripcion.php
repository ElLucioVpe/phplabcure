<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $User_correoUser
 * @property string $Tag_nombreTag
 * @property boolean $ignora
 * @property Tag $tag
 * @property User $user
 */
class Suscripcion extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'suscripcion';

    /**
     * @var array
     */
    protected $fillable = ['ignora'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag()
    {
        return $this->belongsTo('App\Tag', 'Tag_nombreTag', 'nombreTag');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'User_correoUser', 'correoUser');
    }
}
