<?php namespace AppliBD\controllers;

use AppliBD\models\Company;
use AppliBD\models\Game;
use AppliBD\models\Genre;
use AppliBD\models\Personnage;
use AppliBD\models\Platform;

class TD3
{
    public static function Question1()
    {
        $res = Game::all();
    }

    public static function Question2()
    {
        $res = Game::where("name", "like", "%Mario%")->get();
    }

    public static function Question3()
    {
        $res = Game::where("name", "like", "Mario%")->with("personnages")->get() ;
    }

    public static function Question4()
    {
        $jeux = Game::where("name", "like", "Mario%")->get()->filter(function ($jeu) {
            $contient = false;
            foreach ($jeu->ratings as $rating) {
                if (strpos($rating->name, "3+") != false) {
                    $contient = true;
                    break;
                }
            }
            return $contient;
        });
    }

    public static function Question5($cond)
    {
        $res = Game::where("name", "like", $cond)->get();
    }
}
