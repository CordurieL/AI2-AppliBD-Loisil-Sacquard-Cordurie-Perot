<?php namespace AppliBD\models;

class Game extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'game';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function personnages()
    {
        return $this->belongsToMany('\AppliBD\models\Personnage', 'game2character', "game_id", "character_id");
    }

    public function devBy()
    {
        return $this->belongsToMany('AppliBD\models\Company', 'game_developers', 'game_id', 'comp_id');
    }

    public function publishedBy()
    {
        return $this->belongsToMany('AppliBD\models\Company', 'game_publishers', 'game_id', 'comp_id');
    }

    public function ratings()
    {
        return $this->belongsToMany('\AppliBD\models\Rating', 'game2rating', "game_id", "rating_id");
    }

    public function genres(){
        return $this->belongsToMany('\AppliBD\models\Genre', 'game2genre', "game_id", "genre_id");
    }
}
