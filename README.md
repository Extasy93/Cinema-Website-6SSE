# Cinema-Website-6SSE

Site web au thème du Cinéma qui permet le vote et l'affichage de planning en ligne. 

## Installation

1. Cloner le repository: `git clone https://github.com/Extasy93/Cin-ma-Website-6SSE.git`
2. Install apache / nginx pour linux ou bien Xampp pour Windows.
3. Importer et Configurer la base de donnée MySQL

## Docker

Ce site web tourne en production sur un environement docker. Voici comment le mettre en place:

1. Copier tous les fichiers du site dans la racine du deploy.sh
2. Executer le script deploy.sh (il s'occupe de tout) ou bien faite la commande :
  docker build -t cinema-projet .
  docker run -d --network=host --restart=always --name cinema-projet cinema-projet
3. C'est pret ! N'Ouliez pas d'ajouter les paramètres qui vous conviennent en fonction de la configuration de votre docker.

## Base de donnée

Ce projet tourne sur une base de donnée mysql. 
1. Importer la base de donnée SQL dans votre serveur mysql
2. N'oubliez pas de modifier les information de connection à votre base de donnée dans le fichier pdo.php

## License

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT). Feel free to use, modify, and distribute the code as per the terms of the license.
