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

    public static function Question6($cond)
    {
        $res = Company::where("location_country", "like", $cond)->get();
    }

    public static function Question7() // liste des jeux dont le nom contient Mario
    {
        $res = Game::where("name", "like", "%Mario%")->get();
    }

    public static function Question8() // Nom des personnages du jeu 12342
    {
        $res=Game::where("id", "=", "12342")->first()->personnages;
    }

    public static function Question9() // Nom des perso apparu pour la premiere fois dans un jeu contenant le nom Mario
    {
        Personnage::with(["firstGame", function ($query) {
            $query->where("name", "like", "%Mario%");
        }])->get();
    }

    public static function Question10() // Nom des personnages des jeux dont le nom contient 'Mario'
    {
        foreach (Game::where("name", "like", "%Mario%")->with("personnages")->get() as $game) {
            foreach ($game->personnages as $personnage) {
                // echo $personnage->name . "<br>";
            }
        }
    }

    public static function Question11() // jeux développés par une compagnie dont le nom contient 'Sony'
    {
        Game::with(["devBy" => function ($query) {
            $query->where("name", "like", "%Sony%");
        }])->get();
    }
}
