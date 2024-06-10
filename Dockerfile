# Utiliser l'image PHP Apache officielle avec la version 8.2
FROM php:8.2-apache

# Installer les extensions PHP nécessaires pour se connecter à MariaDB
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copier les fichiers de l'application dans le conteneur
COPY . /var/www/html/

# Exposer le port 80 pour Apache
EXPOSE 80
