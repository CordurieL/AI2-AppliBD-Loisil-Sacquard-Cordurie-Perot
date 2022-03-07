<?php
require_once "vendor/autoload.php";

//connection a la base de donnees par le fichier conf.ini

use AppliBD\controllers\TD2;
use Illuminate\Database\Capsule\Manager as DB;

$db = new DB();
$db->addConnection(parse_ini_file(dirname(__FILE__).'/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();

TD2::Question1();
TD2::Question2();
TD2::Question3();
TD2::Question4();
TD2::Question5();
TD2::Question6();
TD2::Question7();
TD2::Question8();
TD2::Question9();