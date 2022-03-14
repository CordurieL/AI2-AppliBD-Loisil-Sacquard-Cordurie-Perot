<?php namespace AppliBD;

use Illuminate\Database\Capsule\Manager as DB;

class Log {
    public static function initialiser() {
        DB::connection()->enableQueryLog();
    }

    public static function afficherLogs() {
        $logs = DB::getQueryLog();
        echo "Nombre de requetes: " . count($logs) . "\n";
        foreach ($logs as $log) {
            //echo "- " . $log['query'] . "\n";
        }
    }
}