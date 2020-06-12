<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $nombreTag
 * @property Suscripcion[] $suscripcions
 * @property Meme[] $memes
 */
class Tag extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tag';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'nombreTag';

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
    protected $fillable = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function suscripcions()
    {
        return $this->hasMany('App\Suscripcion', 'Tag_nombreTag');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function memes()
    {
        return $this->belongsToMany('App\Meme', 'tag_has_meme', 'Tag_nombreTag', 'Meme_idMeme');
    }
}
