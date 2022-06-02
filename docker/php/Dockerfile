FROM php:8.0-apache

RUN apt-get update && apt-get install -y \
  	libfreetype6-dev \
        libjpeg62-turbo-dev \
        libzip-dev \
        libonig-dev \
        libpq-dev \
        unzip \
        cron \
        zlib1g-dev \
        libpng-dev \
        libjpeg-dev \
        libwebp-dev \
    && docker-php-ext-configure gd -with-jpeg=/usr/include/ --with-freetype=/usr/include/ \
    && docker-php-ext-install \
        gd \
        pdo_mysql \
        mysqli \
        zip \
    && a2enmod rewrite

RUN apt-get install -y nodejs npm && npm install n -g && n 16.15.1

COPY --from=composer /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin
