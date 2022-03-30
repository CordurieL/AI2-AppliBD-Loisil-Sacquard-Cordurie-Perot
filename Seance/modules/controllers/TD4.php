<?php namespace AppliBD\controllers;

use AppliBD\models\User;
use AppliBD\models\Comment;

class TD4
{
    public static function Question1()
    {
        $max = User::max('id');
        $min = User::min('id');
        $id = readline("ID de l'utilisateur (entre ".$min." et ".$max.") : ");
        $user = User::find(max($min, min($max, $id)));
        $comments = $user->comments()->orderBy("created_at", "desc")->get();
        echo "Commentaires de l'utilisateur " . $user->name . " " . $user->surname . " :\n";
        foreach ($comments as $comment) {
            $date = $comment->created_at->format("d/m/Y");
            echo "  " . $comment->title . " (" .$date. ")\n";
            echo "    " . $comment->content . "\n";
        }
    }

    /*SELECT * FROM user INNER JOIN comment ON comment.user_id = user.id group by user.id HAVING count(comment.user_id) > 5; */
    public static function Question2()
    {
        $users = User::with("comments")->get()->filter(function ($user) {
            $countComments =  $user->comments->count();
            if ($countComments >23) {
                return $user->name;
            }
        });

        echo "Noms des utilisateurs ayant plus de 5 commentaires\n";
        foreach ($users as $user) {
            echo "    " . $user->name . "\n";
        }
    }
}
