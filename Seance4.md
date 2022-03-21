# AI2 - Appli BD

## Prises de notes de la séance 4

### Partie 1 : modélisation et création des tables

#### Création des tables manquantes

```sql
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
`name` varchar(128) NOT NULL,
`surname` varchar(128) DEFAULT NULL,
`email` varchar(128) DEFAULT NULL,
`adress` varchar(128) DEFAULT NULL,
`phone` varchar(128) DEFAULT NULL,
`birthdate` DATE DEFAULT NULL,
`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`user_email` varchar(128) DEFAULT NULL,
`title` varchar(128) DEFAULT NULL,
`content` TEXT DEFAULT NULL,
`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

### Partie 2 : génération automatique de données
