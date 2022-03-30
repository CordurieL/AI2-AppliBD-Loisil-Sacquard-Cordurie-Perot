<?php
require_once "vendor/autoload.php";

//connection a la base de donnees par le fichier conf.ini

use AppliBD\controllers\Container;
use AppliBD\controllers\TD5;
use AppliBD\controllers\TD5_1;
use AppliBD\controllers\TD5_2;
use AppliBD\controllers\TD5_3;
use Illuminate\Database\Capsule\Manager as DB;

$db = new DB();
$db->addConnection(parse_ini_file(dirname(__FILE__).'/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();

// while (true) {
//     $a = '0';
//     $a = readline("Question numero 1 - 2 (ou 0 pour quitter) : ");
//     if ($a == '0')
//         break;
//     $q = "Question".$a;
//     TD4::$q();
// }

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
    ],
]);

Container::setContainer($app->getContainer());

$app->get("/api/games/{id}[/]", function ($request, $response, $args) {
    $id = $args['id'];
    $game = TD5_1::getGame($id);
    if ($game) {
        return $response->withJson($game);
    } else {
        return $response->withStatus(404);
    }
})->setName("game");

$app->get("/api/games[/]", function ($request, $response, $args) {
    $games = TD5_2::getGames($request->getQueryParam('page'));
    if ($games) {
        return $response->withJson($games);
    } else {
        return $response->withStatus(404);
    }
})->setName("games");

$app->get("/api/games/{id}/comments[/]", function ($request, $response, $args) {
    $id = $args['id'];
    $game = TD5_3::getGameComments($id);
    if ($game) {
        return $response->withJson($game);
    } else {
        return $response->withStatus(404);
    }
})->setName("game_comments");

$app->post("/api/games/{id}/comments[/]", function ($request, $response, $args) {
    $id = $args['id'];
    $game = TD5_1::addGameComment($id, $request->getBody());
    if ($game) {
        return $response->withStatus(201)->withJson($game);
    } else {
        return $response->withStatus(404);
    }
});

$app->get("/api/games/{id}/characters[/]", function ($request, $response, $args) {
    $id = $args['id'];
    $game = TD5_1::getGameCharacters($id);
    if ($game) {
        return $response->withJson($game);
    } else {
        return $response->withStatus(404);
    }
})->setName("game_characters");

$app->get("[/]", function ($request, $response, $args) {
    $response->getBody()->write("
    <h1>Routes:</h1>
    <ul>
        <li><p>/api/games/{id}</p></li>
        <li><p>/api/games</p></li>
        <li><p>/api/games/{id}/comments</p></li>
        <li><p>/api/games/{id}/characters</p></li>
    </ul>
    ");
    return $response;
})->setName("home");

$app->run();
