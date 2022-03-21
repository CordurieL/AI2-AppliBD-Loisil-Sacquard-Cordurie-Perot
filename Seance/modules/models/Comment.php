<?php namespace AppliBD\models;

class Comment extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'comment';
    protected $fillable = ["title", "user_id", "game_id", "content"];
    protected $primaryKey = 'id' ;
    public $timestamps = true ;

    public function user(){
        return $this->belongsTo('\AppliBD\models\User', 'user_id');
    }
}