<?php namespace \AppliBD;

class Timer {
    $time_start;
    public static function start() {
        echo "Lancement du timer\n";
        $this->time_start = microtime(true);
    }

    public static function stop() {
        $time_end = microtime(true);
        $time = $time_end - $this->time_start;
        echo "Arret du timer, temps d'execution: ".$time." secondes\n";
    }
}