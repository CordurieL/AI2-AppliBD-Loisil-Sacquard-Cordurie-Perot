<?php namespace AppliBD\models;

class Model extends \Illuminate\Database\Eloquent\Model {
    protected $table = '';
    // protected $fillable = ['', ''];
    protected $primaryKey = '' ;
    public $timestamps = false ;

    // public function item(){
    //     return $this->belongsTo('\MyWishList\models\Item', 'idItem');
    // }
}