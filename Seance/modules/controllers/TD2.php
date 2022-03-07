<?php namespace AppliBD\controllers;

use AppliBD\models\Company;
use AppliBD\models\Game;
use AppliBD\models\Personnage;
use AppliBD\models\Platform;

class TD2
{
    public static function Question1()
    {
        echo "Question1:\n";
        foreach (Game::where("id", "=", "12342")->first()->personnages as $perso) {
            echo "    - " . $perso->name . " (" . $perso->deck . ")\n";
        }
    }
    
    public static function Question2()
    {
        echo "Question2:\n";
    }
    
    public static function Question3()
    {
        echo "Question3:\n";
        $companies = Company::where("name", "LIKE", "%Sony%")->get()->toArray();
        foreach ($companies as $c) {
            echo "    - " . $c['name'] ."\n";
            $games = Company::where("id", "=", $c['id'])->first()->gamesDev->toArray();
            foreach ($games as $g) {
                echo "        - " . $g['name'] ."\n";
            }
        }
    }
    
    public static function Question4()
    {
        echo "Question4:\n";
    }
    
    public static function Question5()
    {
        echo "Question5:\n";
    }
    
    public static function Question6()
    {
        echo "Question6:\n";
    }
    
    public static function Question7()
    {
        echo "Question7:\n";
    }
    
    public static function Question8()
    {
        echo "Question8:\n";
    }

    public static function Question9()
    {
        echo "Question9:\n";
    }
}
