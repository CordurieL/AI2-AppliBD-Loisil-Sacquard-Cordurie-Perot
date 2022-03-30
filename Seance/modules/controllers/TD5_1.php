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

    public static function make_json($game, $details=true) {
        $res = [
            "game" => [
                "id" => $game->id,
                "name" => $game->name,
                "alias" => $game->alias,
                "deck" => $game->deck,
                "description" => $game->description,
                "original_release_date" => $game->original_release_date
            ],
            "link" => [
                "self" => ["href" => Container::getContainer()->router->pathFor('game', ['id' => $game->id])],
                "comments" => ["href" => Container::getContainer()->router->pathFor("game_comments", ["id" => $game->id])],
                "characters" => ["href" => Container::getContainer()->router->pathFor("game_characters", ["id" => $game->id])]
            ]
        ];
        if ($details) $res["game"]["platforms"] = TD5_1::getPlatforms($game);
        return $res;
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

    public static function addGameComment($game_id, $request) {
        $user = User::where("email", $request->getParam("email"))->first();
        if (!$user) {
            echo "Erreur: impossible de trouver un user avec cet email";
            return null;
        }
        $comment = Comment::create([
            "title" => $request->getParam("title"),
            "user_id" => $user->id,
            "game_id" => $game_id,
            "content" => $request->getParam("content")
        ]);
        return TD5_1::make_comment($comment);
    }

    public static function getComment($id) {
        $comment = Comment::find($id);
        if (!$comment) return [];
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

    public static function generate_addComment($id) {
        return "
            <h1>Add a comment on game {$id}</h1>
            <form action='/api/games/{$id}/comments' method='post'>
                <input type='email' name='email' id='email' placeholder='email' value=''>
                <input type='text' name='title' id='title' placeholder='title' value=''>
                <br>
                <textarea name='content' id='content' placeholder='content' cols='30' rows='10'></textarea>
                <br>
                <button type='submit'>Add comment</button>
            </form>
        ";
    }
}