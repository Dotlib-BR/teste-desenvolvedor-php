FROM php:8.0.3-fpm-buster

USER root

RUN docker-php-ext-install bcmath pdo_mysql

RUN apt-get update
RUN apt-get install -y git zip unzip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

EXPOSE 9000

USER php-user
