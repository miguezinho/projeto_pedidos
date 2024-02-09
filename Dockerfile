FROM php:8.3-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN a2enmod rewrite
RUN service apache2 restart

RUN apt-get update && apt-get install -y \
    software-properties-common \
    npm
RUN npm install npm@latest -g && \
    npm install n -g && \
    n latest

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-install zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . ./

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install 

RUN npm install