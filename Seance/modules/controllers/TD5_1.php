<?php namespace AppliBD\controllers;

use AppliBD\models\Game;

class TD5_1 {
    public static function getGame($id) {
        $game = Game::find($id);
        if (!$game) return [];

        // {
        //     "id": 35444,
        //     "name": "War Thunder",
        //     "alias": "World of Planes",
        //     "deck": "War Thunder is a free-to-play air combat game set in the World War II and Korean War eras.
        //     Naval and land battles are planned additions.",
        //     "description": "...",
        //     "original_release_date": "2013-06-30 00:00:00"
        // }

        $data = [
            "id" => $game->id,
            "name" => $game->name,
            "alias" => $game->alias,
            "deck" => $game->deck,
            "description" => $game->description,
            "original_release_date" => $game->original_release_date
        ];
        return $data;
    }
}