# 1 Lorsque la fonction json_encode() reçoit un tableau PHP, expliquez dans quels cas elle retourne une chaine correspondant
```
Si on utilise json_encode() sans option spécifique, la fonction retournera un tableau json. 
Si on ajoute l'option JSON_FORCE_OBJECT, la fonction retournera un objet json.
```

# 2 en utilisant le micro-framework slim, comment accède-t-on aux données transmises dans la requête sans utiliser les tableau $_GET et $_POST :
## .1 pour les données dans l'url,
```php
$data = $app->request()->get($nomDuParametre);
```

## .2 pour les données dans le corps de la requête
```php
$body = $app->request->headers;
```

# 3 en utilisant slim, comment positionner :
## .1 le code de retour de la réponse (200, 404, 401 …),
```php
$newResponse = $response->withStatus($codeDeRetour);
```

## .2 un header dans la réponse
```php
$newResponse = $oldResponse->withAddedHeader($nom, $valeur);
```