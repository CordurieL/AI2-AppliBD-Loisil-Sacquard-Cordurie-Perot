# AI2 - Appli BD

## Constatations de la séance 3 (approximatives)

### Partie 1 - Cache de requetes SQL

#### Question 1 :

- Première exécution : 1.05 sec
- Exécutions suivantes : 0.99 sec

#### Question 2 :

- Première exécution : 0.65 sec
- Exécutions suivantes : 0.63 sec

#### Question 3 :

- Première exécution : 0.71 sec
- Exécutions suivantes : 0.68 sec

#### Question 4 :

- Première exécution : 1.26 sec
- Exécutions suivantes : 1.21 sec

### Partie 1 - Index

#### Question 1

Le temps d'execution avec les trois valeurs différentes ne change pas, ce qui indique qu'aucune mise en cache est faite

#### Question 2

Noms de jeux qui commencent par ...

- Moyenne des trois requêtes avant INDEX : 0.6590 sec  
  CREATE INDEX indexName ON game (name);
- Moyenne des trois requêtes après INDEX : 0.0218 sec

Noms des jeux qui contiennent ...

- Moyenne des trois requêtes avant INDEX : 0.76 sec  
  CREATE INDEX indexName ON game (name);
- Moyenne des trois requêtes après INDEX : 0.75 sec

#### Question 3

La table company contient 3932 lignes, avec seulement 130 pays (location_country) différents.
Pour la requête demandée, on peut prévoir un parcours moyen de 30 lignes (3932/130) au lieu de 3932, ce qui permettra un gain de performance.

Mise en pratique :

Noms de jeux qui commencent par ...

- Moyenne des trois requêtes avant INDEX : 0.022 sec  
  CREATE INDEX indexCountry ON company (location_country);
- Moyenne des trois requêtes après INDEX : 0.015 sec

### Chargements liés

Nombre de requêtes : 2

Dans les deux Questions, un inner join est utilisé pour faire la selection des données.
Pour la question 1, on peux remarquer que Lavarel fait une première requete pour récupérer tous les ID des jeux correspondant a la condition `name like %Mario%`.  
puis utilise cette liste d'ID dans la deuxième requete pour ne récupérer que les personnages des jeux selectionnés dans la première requête.