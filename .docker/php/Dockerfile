FROM php:8.0.1-fpm

RUN apt-get update \
    && apt-get install -y \
        sudo \
        git \
        wget \
        tar \
        bzip2 \
        unzip \
        zip \
        libzip-dev \
        libcurl4-openssl-dev \
        libonig-dev \
        libxml2-dev \
        libmcrypt-dev \
        nano \
    && docker-php-ext-install pdo pdo_mysql opcache curl zip bcmath \
    && apt-get clean

# install composer from image
COPY --from=composer:2.0.8 /usr/bin/composer /usr/bin/composer

# install xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN apt-get moo
