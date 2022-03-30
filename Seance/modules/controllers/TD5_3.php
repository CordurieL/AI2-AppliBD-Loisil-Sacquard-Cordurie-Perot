<?php namespace AppliBD\controllers;


class TD5_3 {
    public static function getGameComments($id) {
		// http://www.gamepedia.net/api/games/2/comments
        $res = [];
        $comments = Comment::where("game_id", "=", $id)->get();
        foreach ($comments as $comment) {
            array_push($res, [
                "id" => $comment->id,
                "title" => $comment->title,
                "content" => $comment->content,
                "user_id" => $comment->user_id,
                "href" => "/api/games/{$comment->id}/comments"
            ]);
        }
        return $res;
    }
}