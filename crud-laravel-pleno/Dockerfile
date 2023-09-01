FROM php:8.2-apache

WORKDIR /var/www/html

COPY composer.json composer.lock ./
COPY src/ ./src/

RUN apt-get update && \
    apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip unzip && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql

COPY .env .env

RUN chown -R www-data:www-data storage

EXPOSE 80

CMD ["apache2-foreground"]
