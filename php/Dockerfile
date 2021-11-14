FROM php:8.0-apache

RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    vim \
    libxml2-dev \
    zlib1g-dev \
    libpng-dev


RUN docker-php-ext-install mysqli pdo_mysql soap bcmath gd
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite
RUN a2enmod headers
