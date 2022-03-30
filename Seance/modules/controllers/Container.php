<?php namespace AppliBD\controllers;

class Container {
    private static $container;
    
    public static function getContainer() {
        return Container::$container;
    }

    public static function setContainer($cont) {
        Container::$container = $cont;
    }
}