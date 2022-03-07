<?php namespace AppliBD\models;

class Game extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'game';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function personnages() {
        return $this->belongsToMany('\AppliBD\models\Personnage', 'game2character', "game_id", "character_id");
    }
}