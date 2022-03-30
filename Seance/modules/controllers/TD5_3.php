<?php namespace AppliBD\controllers;

use AppliBD\models\Game;

class TD5_3 {
    public static function getGameComments($id) {
        $res = [];
        $comments = Game::find($id)->comments;
        foreach ($comments as $comment) {
            array_push($res, [
                "id" => $comment->id,
                "title" => $comment->title,
                "content" => $comment->content,
                "user_id" => $comment->user_id,
                "created_at" => $comment->created_at,
                "href" => Container::getContainer()->router->pathFor("comments", ["id" => $comment->id])
            ]);
        }
        return $res;
    }
}