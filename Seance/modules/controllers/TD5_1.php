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
                "original_release_date" => $game->original_release_date,
                "platforms" => TD5_1::getPlatforms($game)
            ],
            "link" => [
                "comments" => ["href" => Container::getContainer()->router->pathFor("game_comments", ["id" => $game->id])],
                "characters" => ["href" => Container::getContainer()->router->pathFor("game_characters", ["id" => $game->id])]
            ]
        ];
    }

    public static function getPlatforms($game) {
        $res = [];
        $platforms = $game->platforms;
        foreach ($platforms as $platform) {
            array_push($res, [
                "id" => $platform->id,
                "name" => $platform->name,
                "alias" => $platform->alias,
                "abbreviation" => $platform->abbreviation,
                "href" => Container::getContainer()->router->pathFor("platforms", ["id" => $platform->id])
            ]);
        }
        return $res;
    }

    public static function getGameCharacters($id) {
        $characters = Game::find($id)->personnages;
        $res = [];
        foreach ($characters as $char) {
            array_push($res, [
                "character" => [
                    "id" => $char->id,
                    "name" => $char->name
                ],
                "links" => [
                    "self" => ["href" => Container::getContainer()->router->pathFor("game_characters", ["id" => $id])]
                ]
            ]);
        }
        return ["characters" => $res];
    }

    public static function addGameComment($game_id, $body) {
        var_dump(json_decode($body, true));
    }
}