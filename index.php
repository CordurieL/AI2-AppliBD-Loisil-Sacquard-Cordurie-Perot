<?php
require_once "vendor/autoload.php";

//connection a la base de donnees par le fichier conf.ini

use AppliBD\controllers\TD1;
use Illuminate\Database\Capsule\Manager as DB;

$db = new DB();
$db->addConnection(parse_ini_file(dirname(__FILE__).'/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();

while (true) {
    $c = false;
    $a = '-1';
    while (!$c) {
        $a = readline("Question numero '1' - '2' - '3' - '4' - '5' (ou '0' pour quitter) : ");
        if ($a == "1" || $a == "2" || $a == "3" || $a == "4" || $a == "5" || $a == "0") {
            $c = true;
        }
    }
    $c = false;

    if ($a == '0') {
        break;
    }
    $q = "Question".$a;
    TD1::$q();
}
