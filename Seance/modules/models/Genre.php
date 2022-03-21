<?php namespace AppliBD\models;

class Genre extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'genre';
    protected $fillable = ["name", "deck", "description"];
    protected $primaryKey = 'id' ;
    public $timestamps = false ;

    public function games(){
        return $this->belongsToMany('\AppliBD\models\Game', 'game2genre', "genre_id", "game_id");
    }
}