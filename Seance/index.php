<?php
require_once "vendor/autoload.php";

//connection a la base de donnees par le fichier conf.ini

use AppliBD\controllers\TD3;
use AppliBD\Timer;
use AppliBD\Log;
use Illuminate\Database\Capsule\Manager as DB;

$db = new DB();
$db->addConnection(parse_ini_file(dirname(__FILE__).'/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();
Log::initialiser();

while (true) {
    $c = false;
    $a = '-1';
    $a = readline("Question numero 1 - 6 (ou 0 pour quitter) : ");
    if ($a == '0')
        break;
    $q = "Question".$a;
    if ($a > 4) {
        $cond = readline("Condition : ");
        Timer::start();
        TD3::$q($cond);
        Timer::stop();
    } else {
        Timer::start();
        TD3::$q();
        Timer::stop();
    }
    echo "\nLogs:\n";
    Log::afficherLogs();
}