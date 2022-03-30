<?php namespace AppliBD\controllers;

use AppliBD\models\Game;

class TD5_2
{
    public static function getGames($page = null)
    {
        $jsonGamesArray = [];
        $gamesCollection = Game::take(200)->get();
        foreach ($gamesCollection as $game) {
            array_push($jsonGamesArray, TD5_1::make_json($game));
        }
        return $jsonGamesArray;
    }
}
