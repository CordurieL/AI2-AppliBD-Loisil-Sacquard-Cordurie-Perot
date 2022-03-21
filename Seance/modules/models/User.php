<?php namespace AppliBD\models;

class Model extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'user';
    protected $fillable = ["name", "surname", "email", "address", "phone", "birthdate"];
    protected $primaryKey = 'id' ;
    public $timestamps = true ;

    public function comments(){
        return $this->hasMany('\AppliBD\models\Comment', 'user_id');
    }
}