<?php namespace AppliBD;

use Illuminate\Database\Capsule\Manager as DB;

class Log {
    public static function initialiser() {
        DB::connection()->enableQueryLog();
    }

    public static function afficherLogs() {
        foreach (DB::getQueryLog() as $log) {
            echo "- " . $log['query'] . "\n";
        }
    }
}