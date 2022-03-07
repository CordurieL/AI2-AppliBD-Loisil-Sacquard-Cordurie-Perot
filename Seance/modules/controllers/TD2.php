<?php namespace AppliBD\controllers;

use AppliBD\models\Company;
use AppliBD\models\Game;
use AppliBD\models\Genre;
use AppliBD\models\Personnage;
use AppliBD\models\Platform;

class TD2
{
    public static function Question1()
    {
        echo "Question1: Personnages du jeu 12342\n";
        foreach (Game::where("id", "=", "12342")->first()->personnages as $perso) {
            echo "    - " . $perso->name . " (" . $perso->deck . ")\n";
        }
        echo "\n";
    }
    
    public static function Question2()
    {
        echo "Question2: Personnages des jeux dont le nom commence par Mario\n";
        foreach (Game::where("name", "like", "Mario%")->with("personnages")->get() as $jeu) {
            foreach ($jeu->personnages as $perso) {
                echo "    - " . $perso->name . "\n";
            }
        }
        echo "\n";
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
        echo "Question4: Rating initial des jeux dont le nom contient Mario\n";
        $games = Game::where("name", "LIKE", "%Mario%")->get()->toArray();
        foreach ($games as $g) {
            echo "    - " . $g['name'];
            $ratings = Game::where("id", "=", $g['id'])->first()->ratings;
            foreach ($ratings as $rating) {
                $rating_board = $rating->rating_boards;
                echo "  (" . $rating_board['name'] .")";
            }
            echo "\n";
        }
    }
    
    public static function Question5()
    {
        echo "Question5: Les jeux dont le nom debute par Mario contenant plus de 3 personnages\n";
        $jeux = Game::with("personnages")->where("name", "like", "Mario%")->get()->filter(function ($jeu) {
            return $jeu->personnages->count() > 3;
        });
        foreach ($jeux as $jeu) {
            echo "    - " . $jeu->name . "\n";
        }
    }
    
    public static function Question6()
    {
        echo "Question6: Jeux dont le nom debute par Mario et dont le rating initial contient 3+\n";
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
        foreach ($jeux as $jeu) {
            echo "    - " . $jeu->name . "\n";
        }
    }
    
    public static function Question7()
    {
        echo "Question7: Les jeux dont le nom débute par Mario, publiés par une compagnie dont le nom contient 'Inc.' et dont le rating initial contient '3+'\n";
        $jeux = Game::where("name", "like", "Mario%")->get()->filter(function ($jeu) {
            $contient = false;
            $publishers = $jeu->publishedBy;
            foreach ($publishers as $publisher) {
                if (strpos($publisher->name, "Inc.") != false) {
                    $contient = true;
                    break;
                }
            }
            $contient2 = false;
            foreach ($jeu->ratings as $rating) {
                if (strpos($rating->name, "3+") != false) {
                    $contient2 = true;
                    break;
                }
            }
            return $contient && $contient2;
        });
        foreach ($jeux as $jeu) {
            echo "    - " . $jeu->name . "\n";
        }
    }
    
    public static function Question8()
    {
        echo "Question8: Les jeux dont le nom débute Mario, publiés par une compagnie dont le nom contient 'Inc', dont le rating initial contient '3+' et ayant reçu un avis de la part du rating board nommé 'CERO'\n";
        $jeux = Game::where("name", "like", "Mario%")->get()->filter(function ($jeu) {
            $contient = false;
            $publishers = $jeu->publishedBy;
            foreach ($publishers as $publisher) {
                if (strpos($publisher->name, "Inc.") != false) {
                    $contient = true;
                    break;
                }
            }
            $contient2 = false;
            foreach ($jeu->ratings as $rating) {
                if (strpos($rating->name, "3+") != false) {
                    $contient2 = true;
                    break;
                }
            }
            $contient3 = false;
            $ratings = $jeu->ratings;
            foreach ($ratings as $rating) {
                $rating_board = $rating->rating_boards;
                if (strcmp($rating_board->name, "CERO") == 0) {
                    $contient3 = true;
                    break;
                }
            }
            return ($contient && $contient2 && $contient3);
        });
        foreach ($jeux as $jeu) {
            echo "    - " . $jeu->name . "\n";
        }
    }

    public static function Question9()
    {
        echo "Question9: Ajouter un nouveau genre de jeu, et l'associer aux jeux 12, 56, 345\n";
        $genre = new \AppliBD\models\Genre([
            "name" => "NewGenre",
            "deck" => "NewGenreDeck",
            "description" => "NewGenreDesc"
        ]);
        if (Genre::where("name", "=", "NewGenre")->first() == null) {
            // premiere execution de la question
            $genre->save();
            echo "    - Genre ajouté\n";

            Game::where("id", "=", 12)->first()->genres()->save($genre);
            Game::where("id", "=", 56)->first()->genres()->save($genre);
            Game::where("id", "=", 345)->first()->genres()->save($genre);
            echo "    - Associations terminés\n";
        } else {
            echo "    - Genre déjà existant, on n'execute pas la question\n";
        }
    }
}
