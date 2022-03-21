<?php
require_once "vendor/autoload.php";

use AppliBD\models\Comment;
use AppliBD\models\User;
use Illuminate\Database\Capsule\Manager as DB;

$db = new DB();
$db->addConnection(parse_ini_file(dirname(__FILE__).'/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();

function createUser() {
    $fake = Faker\Factory::create();
    $name = explode(" ", $fake->name());
    return User::create([
        "name" => $name[0],
        "surname" => $name[1],
        "email" => $fake->email(),
        "address" => $fake->address(),
        "phone" => $fake->phoneNumber(),
        "birthdate" => $fake->dateTime()
    ]);
}

function createComment($userID) {
    $fake = Faker\Factory::create();
    return Comment::create([
        "title" => $fake->title(),
        "user_id" => $userID,
        "content" => $fake->sentence()
    ]);
}

echo "Creating users...\n";
for ($i=0; $i < 25000; $i++) { 
    if ($i % 250 == 0) echo ($i / 250) . "%\r";
    $user = createUser();
    for ($j=0; $j < 10; $j++) { 
        createComment($user->id);
    }
}
echo "\nDone!\n";