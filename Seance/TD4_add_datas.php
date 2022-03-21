<?php
require_once "vendor/autoload.php";

//connection a la base de donnees par le fichier conf.ini

use Illuminate\Database\Capsule\Manager as DB;
use AppliBD\models\User;
use AppliBD\models\Comment;

$db = new DB();
$db->addConnection(parse_ini_file(dirname(__FILE__).'/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();

    if (User::where('email', '=', "firstManOnEarth@gmail.com")->first() === null) {
        $user1 = User::create([
    "name" => "D'eden",
    "surname" => "Adam",
    "email" => "firstManOnEarth@gmail.com",
    "adress" => "Jardin d'Eden a cote du banc",
    "phone" => "0600000001",
    "birthdate" => new DateTime("1974-04-01"),
        ]);

        $user2 = User::create([
    "name" => "Damon",
    "surname" => "Matt",
    "email" => "lastManOnMars@yahoo.com",
    "adress" => "ISS",
    "phone" => "07007007007",
    "birthdate" => new DateTime("1970-10-08"),
        ]);

        $comment1 = Comment::create([
    "user_id" =>$user1->id,
    "game_id" => 12342,
    "title" => "Super se jeux vrement",
    "content" => "moi meme que jai bien aimer...",
]);

        $comment2 = Comment::create([
    "user_id" =>$user1->id,
    "game_id" => 12342,
    "title" => "Petite correction svp",
    "content" => "Excusez j'avais mal écris 'vraiment' mais sinon super le jeu.",
]);

        $comment3 = Comment::create([
    "user_id" =>$user1->id,
    "game_id" => 12342,
    "title" => "Encore un commentaire",
    "content" => "Trop tôt pour tomber à court d'idées je suppose.",
]);

        $comment4 = Comment::create([
    "user_id" =>$user2->id,
    "game_id" => 12342,
    "title" => "trop nul",
    "content" => "nul",
]);

        $comment5 = Comment::create([
    "user_id" =>$user2->id,
    "game_id" => 12342,
    "title" => "javaizoublier",
    "content" => "first*",
]);

        $comment6 = Comment::create([
    "user_id" =>$user2->id,
    "game_id" => 12342,
    "title" => "Enfin bref, on va utiliser Faker",
    "content" => "Trop long de tout écrire soi-même",
]);
    }
