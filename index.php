<?php
require_once "vendor/autoload.php";

//connection a la base de donnees par le fichier conf.ini

use AppliBD\controllers\TD1;
use Illuminate\Database\Capsule\Manager as DB;

$db = new DB();
$db->addConnection(parse_ini_file(dirname(__FILE__).'/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();

TD1::Question1();

TD1::Question2();

TD1::Question3();

TD1::Question4();

TD1::Question5();
