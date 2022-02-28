<?php namespace AppliBD\controllers;

use AppliBD\models\Game;

class TD1 {
    static function Question1() {
        echo "Question 1:\n";
        echo "Liste les jeux contenant le mot 'Mario' dans leur nom :\n";
        foreach (Game::where("name", "like", "%Mario%")->get() as $jeu) { 
            echo "  " . $jeu->name . "\n";
        }
        echo "\n";
    }
}