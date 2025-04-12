# Utilisation de PHP 8.2 avec Apache
FROM php:8.2-apache

# Mise à jour et installation des dépendances nécessaires
RUN apt update \
    && apt install -y build-essential curl zlib1g-dev g++ git libicu-dev zip libzip-dev \
    libpng-dev libjpeg-dev libwebp-dev libfreetype6-dev libssl-dev pkg-config libpq-dev \
    && docker-php-ext-install intl opcache pdo pdo_pgsql \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && docker-php-ext-configure gd --with-freetype --with-webp --with-jpeg \
    && apt clean

# Installation de l'extension MongoDB pour PHP
RUN pecl install mongodb \
    && echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongodb.ini

# Configuration d'Apache
COPY Docker/config/apache/default.conf /etc/apache2/sites-enabled/000-default.conf


# Installation de Composer
RUN curl -sS https://getcomposer.org/download/2.8.5/composer.phar -o /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer

WORKDIR /var/www

# Copie du code source de l'application
COPY ./app /var/www

# Installation des dépendances PHP avec Composer
RUN composer install --optimize-autoloader --no-scripts

# Création des répertoires nécessaires et permissions
RUN mkdir -p var/cache/prod \
    && mkdir -p var/log \
    && chmod 777 ./var/cache/prod \
    && chmod 777 ./var/log

# Exposition du port 80
EXPOSE 80