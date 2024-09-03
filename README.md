# RDV - Plateforme de réservation de rdv médical

Voici notre plateforme de réservation de rdv médical. Cette application a été réalisé à l'aide de 
REACT JS et API PLATFORM.

Nous avons donc une partie client et server.

## Configurer la partie server API PLATFORM

Récupérer le fichier .env

Build le projet : `docker-compose build`

Une fois le projet build le lancer avec cette commande : `docker-compose up -d`

Ensuite il faut faire une migration des données 

docker compose exec php composer install

docker compose exec php bin/console cache:clear

docker compose exec php bin/console d:d:d --force

docker compose exec php bin/console d:d:c

docker compose exec php bin/console make:migration

docker compose exec php bin/console d:m:m

Accéder au projet sur l'url localhost:8888

Vérifier si l'accès à localhost:8888/api/docs


