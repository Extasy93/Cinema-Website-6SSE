# Utilisez une image officielle de PHP avec Apache
FROM php:7.4-apache

# Installez le pilote MySQL pour PHP
RUN docker-php-ext-install mysqli pdo_mysql

# Copiez les fichiers PHP de votre répertoire local vers le conteneur
COPY ./ /var/www/html/

# Exposez le port 80 pour le trafic HTTP
EXPOSE 80

# Démarrer Apache une fois que le conteneur est en cours d'exécution
CMD ["apache2-foreground"]
