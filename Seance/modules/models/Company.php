<?php namespace AppliBD\models;

class Company extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'company';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function gamesDev()
    {
        return $this->belongsToMany('AppliBD\models\Game', 'game_developers', 'comp_id', 'game_id');
    }
}
