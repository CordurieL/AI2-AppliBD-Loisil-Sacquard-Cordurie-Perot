<?php namespace AppliBD\models;

class Game_rating extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'game_rating';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function jeu(){
        return $this->belongsToMany('\AppliBD\models\Game', 'game2rating', 'game_id', 'rating_id');
    }
}