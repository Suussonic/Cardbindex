# Documentation Docker

## Pré-requis

- [Docker](https://www.docker.com/)

## Utilisation de Docker pour le développement PHP avec MariaDB

Ce dépôt contient un environnement Docker pour le développement PHP avec un serveur Apache et une base de données MariaDB. L'image PHP Apache officielle avec la version 8.2 est utilisée pour le serveur web, et l'image MariaDB est utilisée pour la base de données.

## Configuration Docker

Le fichier `Dockerfile` définit la configuration de l'image Docker pour le serveur PHP Apache :

````Dockerfile
# Utiliser l'image PHP Apache officielle avec la version 8.2
FROM php:8.2-apache

# Installer les extensions PHP nécessaires pour se connecter à MariaDB
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copier les fichiers de l'application dans le conteneur
COPY . /var/www/html/

# Exposer le port 80 pour Apache
EXPOSE 80
````

Le fichier docker-compose.yml définit la configuration pour exécuter les services PHP, MariaDB et phpMyAdmin :

````yml
version: '3'
services:
  php:
    build: .
    ports:
      - "8080:80"
    volumes:
      - .:/var/www/html 
    depends_on:
      - mariadb  

  mariadb:
    image: mariadb
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: tn3bbjTDe5UQ
      MYSQL_DATABASE: promo4

  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    restart: always
    ports:
      - "8181:80"
    environment:
      PMA_HOST: mariadb
      PMA_USER: root
      PMA_PASSWORD: tn3bbjTDe5UQ
````

## Utilisation de la base de données

Pour vous connecter à la base de données MariaDB depuis votre application PHP, vous pouvez utiliser le fichier db.php avec le code suivant :

```php
<?php

$user = 'root';
$password = 'tn3bbjTDe5UQ';
$options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

try {
    // $dbh = new PDO('mysql:host=localhost;dbname=promo4', $user, $password, $options); # Config XAMPP
    $dbh = new PDO('mysql:host=mariadb;dbname=promo4', $user, $password, 
    $options); # Config Docker
} catch (PDOException $e) {
    var_dump($e);
}
```

## Documentation

- [PHP](https://www.php.net/manual/fr/install.php)
- [Apache](https://httpd.apache.org/)
- [phpMyAdmin](https://www.phpmyadmin.net/)
- [Docker](https://docs.docker.com/)
- [Dockerfile](https://docs.docker.com/engine/reference/builder/)
- [Docker Compose](https://docs.docker.com/compose/)
