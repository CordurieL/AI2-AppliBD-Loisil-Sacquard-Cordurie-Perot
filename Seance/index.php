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
    $game = TD5_3::getGameComments($id, $request->getQueryParam("page"));
    if ($game) {
        return $response->withJson($game);
    } else {
        return $response->withStatus(404);
    }
})->setName("game_comments");

$app->get("/api/games/{id}/addComment[/]", function ($request, $response, $args) {
    $id = $args['id'];
    $response->getBody()->write(TD5_1::generate_addComment($id));
})->setName("add_comment");

$app->post("/api/games/{id}/comments[/]", function ($request, $response, $args) {
    $id = $args['id'];
    $game = TD5_1::addGameComment($id, $request);
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

$app->get("/api/platforms/{id}[/]", function ($request, $response, $args) {
    $id = $args['id'];
    $platform = TD5_2::getPlatform($id);
    if ($platform) {
        return $response->withJson($platform);
    } else {
        return $response->withStatus(404);
    }
})->setName("platforms");

$app->get("/api/comments/{id}[/]", function ($request, $response, $args) {
    $id = $args['id'];
    $comment = TD5_1::getComment($id);
    if ($comment) {
        return $response->withJson($comment);
    } else {
        return $response->withStatus(404);
    }
})->setName("comments");

$app->get("[/]", function ($request, $response, $args) {
    $response->getBody()->write("
    <h1>Routes:</h1>
    <ul>
        <li><p>/api/games/{id}</p></li>
        <li><p>/api/platforms/{id}</p></li>
        <li><p>/api/comments/{id}</p></li>
        <li><p>/api/games</p></li>
        <li><p>/api/games/{id}/addComment</p></li>
        <li><p>/api/games/{id}/comments</p></li>
        <li><p>/api/games/{id}/characters</p></li>
    </ul>
    ");
    return $response;
})->setName("home");

$app->run();
