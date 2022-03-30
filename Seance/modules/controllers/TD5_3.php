<?php namespace AppliBD\controllers;

use AppliBD\models\Game;

class TD5_3
{
    public static function getGameComments($id, $page)
    {
        $res = [];
        $commentsArray = [];
        $comments = Game::find($id)->comments()->offset((($page == null ? 1 : $page)-1)*100)->limit(100)->get();
        //->skip((($page == null ? 1 : $page)-1)*100)->take(100);
        foreach ($comments as $comment) {
            array_push($commentsArray, [
                "id" => $comment->id,
                "title" => $comment->title,
                "content" => $comment->content,
                "user_id" => $comment->user_id,
                "created_at" => $comment->created_at,
                "href" => Container::getContainer()->router->pathFor("comments", ["id" => $comment->id])
            ]);
        }
        $res["comments"] = $commentsArray;
        return $res;
    }
}

/*$maxPage = round((Game::count()/200), 0, PHP_ROUND_HALF_UP);
        $res = [];
        $jsonGamesArray = [];
        $gamesCollection = Game::where("id", ">=", (($checkedPage-1)*200)+1)->take(200)->get();//Game::take(200)->get();
        foreach ($gamesCollection as $game) {
            $gameToUpdate = TD5_1::make_json($game);
            $gameToUpdate["links"] = ["self" => ["href" => Container::getContainer()->router->pathFor('game', ['id' => $game->id])]];
            array_push($jsonGamesArray, $gameToUpdate);
        }
        $res["comments"] = $jsonGamesArray;
        return $res;*/
