<?php namespace AppliBD\controllers;

use AppliBD\models\Game;
use AppliBD\models\Company;
use AppliBD\models\Platform;

class TD1
{
    public static function Question1()
    {
        echo "Question 1:\n";
        echo "Liste les jeux contenant le mot 'Mario' dans leur nom :\n";
        foreach (Game::where("name", "like", "%Mario%")->get() as $jeu) {
            echo "  " . $jeu->name . "\n";
        }
        echo "\n";
    }

    public static function Question2()
    {
        echo "Question 2:\n";
        echo "Liste des compagnies installees au Japon :\n";
        foreach (Company::where("location_country", "=", "japan")->get() as $company) {
            echo "  " . $company->name . "\n";
        }
        echo "\n";
    }

    public static function Question3()
    {
        echo "Question 3:\n";
        echo "liste des platformes dont la base installée est >= 10 000 000 :\n";
        foreach (Platform::where("install_base", ">=", 10000000)->get() as $platform) {
            echo " " . $platform->name . "\n";
        }
        echo "\n";
    }

    public static function Question4()
    {
        echo "Question 4:\n";
        echo "Liste des 442 jeux a partir du jeu 21173 :\n";
        foreach (Game::where("id", ">=", 21173)->take(442)->get() as $jeu) {
            echo "  " . $jeu->name . "\n";
        };
        echo "\n";
    }

    public static function Question5()
    {
        echo "Question 5:\n";
        echo "Jeux et leurs descriptions par groupes de 500 :\n";
        $i = 0;
        $a=true;
        while ($a) {
            foreach (Game::where("id", ">=", $i*500+1)->take(500)->get() as $game) {
                echo "  Name : " . $game->name . "\n  Deck : " . $game->deck . "\n#######################################\n";
            }
            $i++;
            $a = readline("Continuer ? y/n : ") == "y";
        }
        echo "\n";
    }
}
