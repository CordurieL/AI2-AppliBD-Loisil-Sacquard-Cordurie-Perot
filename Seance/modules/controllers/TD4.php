<?php namespace AppliBD\controllers;

use AppliBD\models\User;
use AppliBD\models\Comment;

class TD4
{

    
    static function Question1() {
        $max = User::max('id');
        $min = User::min('id');
        $id = readline("ID de l'utilisateur (entre ".$min." et ".$max.") : ");
        $user = User::find(max($min, min($max, $id)));
        $comments = $user->comments()->orderBy("created_at", "desc")->get();
        echo "Commentaires de l'utilisateur " . $user->name . " " . $user->surname . " :\n";
        foreach($comments as $comment) {
            $date = $comment->created_at->format("d/m/Y");
            echo "  " . $comment->title . " (" .$date. ")\n";
            echo "    " . $comment->content . "\n";
        }
    }
}
