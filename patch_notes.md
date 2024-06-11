# Patch Notes

## Modifications :

- Ajout de Docker avec un docker-composer et un Dockerfile pour lancer le serveur local avec la base de données mariaDB et un phpMyAdmin.
- Mise a jour des favicons sur toutes les pages
- Modification de la page de suppression des cartes. (Utilisation de JS + PHP pour supprimer les cartes de l'utilisateur en direct, sans rechargement de la page.)
- Mise a jour du JS de Jquery en Javascript pure, car JS peut faire exactement comment Jquery maintenant sur tout les navigateurs.
- Suppression de certains imports inutiles.
- Fermetures de certains balises HTML qui ne sont pas fermer correctement.
- Mise a jour de la nav qui n'etait pas afficher correctement sur tout les pages (icones)
- Changement de theme du site, fonctionnel sur la page d'accueil et de profil. Tu peux choisir entre noir et blanc, et il sera automatiquement applique au site et changer dans la ddb.
- Suppression de certain session_start(); qui était déclarer plusieurs fois, ce qui provoqué une erreur.
- Changement dans le fichier db.php pour ce connecter à la ddb de mariaDB avec Docker.
- Ajout de fichiers css pour les themes respectivements : black.css (Theme sombre) white.css (Theme clair) default.css (Theme par defaut) [Je n'ai pas fait le css juste une colo-background de la couleur du theme]

## Améliorations :

- ⚠️ Faire en sorte que les utilisateurs ne peuvent pas crée un compte avec le même mail qu'un autre.
- ❗Faire le responsive du site web.
- Faire une table de jointure entre les classeurs et les users pour ne pas avoir à avoir dans la ddb, plusieurs ligne pour un seul utilisateur.
- Supprimer ou commenter certaines pages ou boutons qui ne sont pas utilisable pour l'instant (Marché, Mot de passe oublié..)
- Avoir pendant la recherche de cartes pokemons, des suggestion de cartes Pokemon.
