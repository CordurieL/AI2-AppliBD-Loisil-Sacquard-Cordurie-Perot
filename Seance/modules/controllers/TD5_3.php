<?php namespace AppliBD\controllers;

use AppliBD\models\Comment;

class TD5_3 {
    public static function getGameComments($id) {
        $res = [];
        $comments = Comment::where("game_id", "=", $id)->get();
        foreach ($comments as $comment) {
            array_push($res, [
                "id" => $comment->id,
                "title" => $comment->title,
                "content" => $comment->content,
                "user_id" => $comment->user_id,
                "created_at" => $comment->created_at,
                "href" => "/api/games/{$comment->id}/comments"
            ]);
        }
        return $res;
    }
}