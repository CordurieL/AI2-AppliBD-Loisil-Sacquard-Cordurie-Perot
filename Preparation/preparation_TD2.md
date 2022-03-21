# 1. rappeler le schéma SQL correspondant.

```
Categorie (id: int, nom: text, descr: text)
Annonce (id: int, titre: text, date: date, texte: text)
Photo (id: int, file: text, date: date, taille_octet: int, id_annonce: int)
Categrie_Annonce (id_categorie: int, id_annonce: int)
```

# 2. proposer les méthodes réalisant les associations pour la classe Annonce et pour la classe Photo
## indiquez en particulier, pour chaque cas, quelle est la méthode prédéfinie Eloquent qu'il faut utiliser.
```
// Pour la question 2 
// Dans le Model Photo
    public function annonce()
    {
        return $this->belongsTo('PrepaTD2\models\Annonce', ['id_annonce']);
    }

// Dans le Model Annonce
    public function photos()
    {
        return $this->hasMany('PrepaTD2\models\Photo', ['id']); // ou id_annonce selon ce qu'on décide de mettre dans le Model Annonce en PK
    }
```


# 3. écrivez les requêtes suivantes avec eloquent :
1. les photos de l'annonce 22
```
$photos = Photo::where('id_annonce', '=', 22)->get();
```

2. les photos de l'annonce 22 dont la taille en octets est > 100000
```
$photos = Annonce::where("id", "=", "22")->photos()->where('taille_octet', '>', 100000)->get();
```

3. les annonces possédant plus de 3 photos
```
$annonces = Annonce::has('photos', '>', 3)->get();
```
4. les annonces possédant des photos dont la taille est > 100000
```
$annonces = Annonce::whereHas('photos', function($p){
    $p->where('taille_octet', '>', 100000);
})->get();
```

# 4. ajouter une photo à l'annonce 22
```
Annonce::where("id", "=", "22")->photos()->save(new Photo([...]));
```

# 5. ajouter l'annonce 22 aux catégories 42 et 73
```
Categorie::where("id", "=", "42")->annonces()->associate(Annonce::where("id", "=", "22"));
Categorie::where("id", "=", "73")->annonces()->associate(Annonce::where("id", "=", "22"));
```