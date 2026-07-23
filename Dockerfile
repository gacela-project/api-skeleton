# syntax=docker/dockerfile:1

# --- Stage 1: install production dependencies -------------------------------
FROM composer:2 AS vendor

WORKDIR /app
COPY composer.json ./
RUN composer update --no-dev --no-scripts --classmap-authoritative --no-interaction --prefer-dist

COPY . .
RUN composer dump-autoload --classmap-authoritative --no-dev

# --- Stage 2: apache + php runtime ------------------------------------------
FROM php:8.4-apache AS runtime

RUN docker-php-ext-install opcache

COPY docker/opcache.ini /usr/local/etc/php/conf.d/zz-opcache.ini
COPY docker/apache-vhost.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite \
    && echo "ServerName localhost" >> /etc/apache2/apache2.conf

WORKDIR /var/www/html
COPY --from=vendor /app .

RUN cp -n app-config.dist.php app-config.php \
    && chown -R www-data:www-data /var/www/html

EXPOSE 80
