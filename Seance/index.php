<?php
require_once "vendor/autoload.php";

//connection a la base de donnees par le fichier conf.ini

use AppliBD\controllers\TD4;
use Illuminate\Database\Capsule\Manager as DB;

$db = new DB();
$db->addConnection(parse_ini_file(dirname(__FILE__).'/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();

while (true) {
    $a = '0';
    $a = readline("Question numero 1 - 2 (ou 0 pour quitter) : ");
    if ($a == '0')
        break;
    $q = "Question".$a;
    TD4::$q();
}