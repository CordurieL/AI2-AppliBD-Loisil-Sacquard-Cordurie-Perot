<?php namespace AppliBD\models;

class Personnage extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'character';
    // protected $fillable = ['', ''];
    protected $primaryKey = 'id' ;
    public $timestamps = false ;

    public function games(){
        return $this->belongsToMany('\MyWishList\models\Game', 'game2character', "character_id", "game_id");
    }
}