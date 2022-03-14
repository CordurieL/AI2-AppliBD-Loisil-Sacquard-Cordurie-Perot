<?php namespace AppliBD;

class Timer {
    private static $time_start;
    public static function start() {
        echo "Lancement du timer\n";
        Timer::$time_start = microtime(true);
    }

    public static function stop() {
        $time_end = microtime(true);
        $time = $time_end - Timer::$time_start;
        echo "Arret du timer, temps d'execution: ".$time." secondes\n";
    }
}