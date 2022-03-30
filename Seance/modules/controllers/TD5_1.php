<?php namespace AppliBD\controllers;

use AppliBD\models\Comment;
use AppliBD\models\Game;
use AppliBD\models\User;

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
        $data = json_decode($body, true);
        $user = User::find($data["email"]);
        if (!$user) return null;
        $comment = Comment::create([
            "title" => $data["title"],
            "user_id" => $user->id,
            "game_id" => $game_id,
            "content" => $data["content"]
        ]);
        return TD5_1::make_comment($comment);
    }

    public static function make_comment($comment) {
        return [
            "comment" => [
                "id" => $comment->id,
                "title" => $comment->title,
                "content" => $comment->content,
                "user_id" => $comment->user_id,
                "created_at" => $comment->created_at
            ],
            "links" => [
                "self" => ["href" => Container::getContainer()->router->pathFor("comments", ["id" => $comment->id])]
            ]
        ];
    }
}