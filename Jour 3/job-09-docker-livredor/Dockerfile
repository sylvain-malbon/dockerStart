FROM php:8.2-apache

RUN a2enmod rewrite

RUN docker-php-ext-install pdo pdo_mysql mysqli

# Uncomment if you need image processing support.
# RUN docker-php-ext-install gd

COPY . /var/www/html/