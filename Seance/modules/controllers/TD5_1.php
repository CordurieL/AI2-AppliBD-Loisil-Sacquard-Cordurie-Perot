<?php namespace AppliBD\controllers;

use AppliBD\models\Game;

class TD5_1 {
    public static function getGame($id) {
        $game = Game::find($id);
        if (!$game) return [];
        return TD5_1::make_json($game);
    }

    public static function make_json($game) {
        return [
            "game" => [
                "id" => $game->id,
                "name" => $game->name,
                "alias" => $game->alias,
                "deck" => $game->deck,
                "description" => $game->description,
                "original_release_date" => $game->original_release_date
            ],
            "link" => [
                "comments" => ["href" => "/api/games/{$game->id}/comments"],
                "characters" => ["href" => "/api/games/{$game->id}/characters"]
            ]
        ];
    }
}