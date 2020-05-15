<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $Tag_nombreTag
 * @property int $Meme_idMeme
 * @property Meme $meme
 * @property Tag $tag
 */
class Tag_has_Meme extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tag_has_meme';

    /**
     * @var array
     */
    protected $fillable = [];

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
    public function tag()
    {
        return $this->belongsTo('App\Tag', 'Tag_nombreTag', 'nombreTag');
    }
}
