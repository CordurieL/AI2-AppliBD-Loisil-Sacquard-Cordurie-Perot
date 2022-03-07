## Partie 1

# 1. écrivez le code pour mesurer le temps d'exécution d'une séquence d'instructions PHP.

```
$debut = microtime(true);
// code à executer 
$fin = microtime(true);

echo 'Temps d execution : '. ($fin - $debut) . ' secondes\n';
```

# 2. rappelez le principe d'un index sur une colonne de table : intérêt, principe de fonctionnement

```
L'indexage est une structure de données qui permet d'accélerer la récupération de données moyennant des coups additionnels d'écriture ainsi que de stockage.

A la place de regarder chaque ligne, on utilise les index pour retrouver l'information.
```

## Partie 2

# 1. Décrivez la structure du log de requêtes dans Eloquent.

```
Si les logs sont activés
DB::connection()->enableQueryLog();
foreach( DB::getQueryLog() as $q){
    // code
}

php log.php
- perso : Big Ears
- perso : Sarah Morrison
- perso : Tia Harribel
-------------- 
query : select * from `game` where `name` like ?
 --- bindings : [  %Mario%, ] ---
-------------- 
 
--------------
query : select * from `game` where `game`.`id` = ? limit 1
 --- bindings : [  12342, ] ---
--------------

--------------
query : select `character`.*, `game2character`.`game_id` as `pivot_game_id`, `game2character`.`character_id` as `pivot_character_id` from `character` inner join `game2character` on `character`.`id` = `game2character`.`character_id` where `game2character`.`game_id` = ?
 --- bindings : [  12342, ] ---
--------------
```

# 2. expliquez le problème des N+1 query

```
Si une table contient un nombre N d'objet, elle va faire une requête pour tous les récupérer et une requête pour chaque objet ce qui donne N+1 requêtes.
Ce qui augmente le nombre de requetes de manière exponentielle (et donc ralenti drastiquement l'application)
```
