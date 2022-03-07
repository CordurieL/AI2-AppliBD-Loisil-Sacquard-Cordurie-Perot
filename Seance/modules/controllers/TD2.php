<?php namespace AppliBD\controllers;

use AppliBD\models\Company;
use AppliBD\models\Game;
use AppliBD\models\Personnage;
use AppliBD\models\Platform;

class TD2
{
    public static function Question1() {
        echo "Question1: Personnages du jeu 12342\n";
        foreach(Game::where("id", "=", "12342")->first()->personnages as $perso) {
            echo "    - " . $perso->name . " (" . $perso->deck . ")\n";
        }
        echo "\n";
    }
    
    public static function Question2() {
        echo "Question2: Personnages des jeux dont le nom commence par Mario\n";
        foreach(Game::where("name", "like", "Mario%")->with("personnages")->get() as $jeu) {
            foreach($jeu->personnages as $perso) {
                echo "    - " . $perso->name . "\n";
            }
        }
        echo "\n";
    }
    
    public static function Question3() {
        echo "Question3:\n";

    }
    
    public static function Question4() {
        echo "Question4:\n";
        foreach(Game::where("name", "LIKE", '%mario%')->first()->rating as $rating) {
            echo "    - " . $rating->id . " (" . $rating->name. "\n";
        }
    }
    
    public static function Question5() {
        echo "Question5:\n";

    }
    
    public static function Question6() {
        echo "Question6:\n";

    }
    
    public static function Question7() {
        echo "Question7:\n";

    }
    
    public static function Question8() {
        echo "Question8:\n";

    }

    public static function Question9() {
        echo "Question9:\n";

    }
}