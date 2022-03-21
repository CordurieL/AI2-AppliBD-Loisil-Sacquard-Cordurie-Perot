<?php namespace AppliBD\models;

class Comment extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'comment';
    protected $fillable = ["title", "user_email", "content"];
    protected $primaryKey = 'id' ;
    public $timestamps = true ;

    public function user(){
        return $this->belongsTo('\AppliBD\models\User', 'user_email');
    }
}