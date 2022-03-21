<?php namespace AppliBD\models;

class Rating extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'game_rating';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function games(){
        return $this->belongsToMany('\AppliBD\models\Game', 'game2rating', "rating_id", "game_id");
    }

    public function rating_boards(){
        return $this->belongsTo('\AppliBD\models\Game', 'rating_board_id');
    }
}