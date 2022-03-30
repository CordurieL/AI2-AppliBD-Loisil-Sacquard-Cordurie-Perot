<?php namespace AppliBD\controllers;

use AppliBD\models\Game;
use AppliBD\models\Platform;

class TD5_2
{
    public static function getGames($page = 1)
    {
        $maxPage = round((Game::count()/200), 0, PHP_ROUND_HALF_UP);
        $checkedPage = $page;
        $checkedPage = $checkedPage == null ? 1 : $checkedPage;
        if ($checkedPage<1) {
            $checkedPage = 1;
        }
        if ($checkedPage>$maxPage) {
            $checkedPage = $maxPage;
        }
        $res = [];
        $jsonGamesArray = [];
        $gamesCollection = Game::offset((($checkedPage)-1)*200)->limit(200)->get();//->skip((($checkedPage)-1)*200)->take(200);
        foreach ($gamesCollection as $game) {
            $gameToUpdate = TD5_1::make_json($game);
            $gameToUpdate["links"] = ["self" => ["href" => Container::getContainer()->router->pathFor('game', ['id' => $game->id])]];
            array_push($jsonGamesArray, $gameToUpdate);
        }
        $res["games"] = $jsonGamesArray;
        $res["links"]= [
            "prev" => ["href" => ($checkedPage > 1) ? "/api/games?page=".($checkedPage-1) : "/api/games?page=".$checkedPage],
            "next" => ["href" => ($checkedPage <  $maxPage) ? "/api/games?page=".($checkedPage+1) : "/api/games?page=".$checkedPage],
        ];
        return $res;
    }

    public static function make_json_platform($platform)
    {
        return [
            "id" => $platform->id,
            "name" => $platform->name,
            "alias" => $platform->alias,
            "abbreviation" => $platform->abbreviation,
            "description" => $platform->description,
            "release_date" => $platform->release_date,
            "original_price" => $platform->original_price,
            "href" => Container::getContainer()->router->pathFor("platforms", ["id" => $platform->id])
        ];
    }

    public static function getPlatform($id)
    {
        $platform = Platform::find($id);
        if (!$platform) {
            return [];
        }
        return TD5_2::make_json_platform($platform);
    }
}
