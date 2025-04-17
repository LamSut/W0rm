FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    unzip \
    zip \
    git \
    libzip-dev \
    libcurl4-openssl-dev \
    libonig-dev \
    && docker-php-ext-install zip pdo pdo_mysql mysqli mbstring

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock /var/www/html/

RUN composer install --no-scripts --no-autoloader

COPY . /var/www/html

RUN composer dump-autoload --optimize --no-scripts